<?php

namespace App\Http\Controllers\API\Adv;

use App\Components\AdvGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdv;
use App\Http\Requests\EditAdv;
use App\Http\Requests\PreviewAdv;
use App\Http\Requests\UpdateAdvStatus;
use App\Http\Resources\AdvResource;
use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvDenialReason;
use App\Models\Backoffice\AdvInterest;
use App\Models\Backoffice\AdvSet;
use App\Models\Backoffice\AdvType;
use App\Models\Backoffice\Interest;
use DB;
use Illuminate\Http\Request;
use Mockery\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests\GetByPeriod;

use Carbon\Carbon;

class AdvController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ], [
            'only' => [
                'getAllAdvs',
                'getAllAdvsByGroupId',
                'createAdv',
                'getAdv',
                'updateAdv',
                'deleteAdv',
                'getPreview'
            ]
        ]);
    }

    /**
     * Display a listing of the advs
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdvs(GetByPeriod $request)
    {
        // Default period = 30 days
        if(!$request->from && !$request->to) {
            $from = Carbon::now()->subDays(30)->format('Y-m-d');
            $to = Carbon::now()->format('Y-m-d');
        } else {

            if(!$request->from) {
                $from = Carbon::now()->subDays(30)->format('Y-m-d');
            } else {
                $from = $request->from;
            }

            if(!$request->to) {
                $to = Carbon::now()->format('Y-m-d');
            } else {
                $to = $request->to;
            }
        }

        if(!isset($request->limit) || !$request->limit) {
            $limit = 30;
        } else {
            $limit = $request->limit;
        }

        if(!isset($request->offset) || !$request->offset) {
            $offset = 0;
        } else {
            $offset = $request->offset;
        }

        $advs = Adv::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->limit($limit)
            ->offset($offset)
            ->where('user_id', '=', auth()->user()->id)
            ->get()
            ->reverse();

        return AdvResource::collection($advs);
    }

    /**
     * Display a listing of the advs
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdvsByGroupId(Request $request)
    {
        return AdvResource::collection(Adv::where('adv_group_id', $request->advgroup)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAdv $request
     * @return AdvResource
     */
    public function createAdv(CreateAdv $request)
    {
        if($request->validated()) {
            $user = auth()->user();

            if($user->hasAccess('advs.create')) {
                $newAdv = Adv::create($request->all() + [
                    'user_id' => $user->id
                ]);

                if(!$newAdv) {
                    abort(409); // Resource creating failed
                } else {
                    $newAdv->budget = $newAdv->advGroup->budget; // Temp fix
                    $newAdv->daily_budget = $newAdv->advGroup->daily_budget;
                    $newAdv->status_global = '0'; // Enabled
                    $newAdv->status_moderation = '1'; // Move to moderation
                    $newAdv->save();
                }

                // Create links on banner-form-types, container-form-types
                foreach($request->sets as $set) {
                    $advSet = new AdvSet;
                    $advSet->adv_id = $newAdv->id;
                    $advSet->banner_form_id = $set['banner_form_id'];
                    $advSet->banner_type_id = $set['banner_type_id'];
                    $advSet->container_form_id = $set['container_form_id'];
                    $advSet->container_type_id = $set['container_type_id'];
                    $advSet->alias = $set['alias'];
                    $advSet->save();
                }

                DB::connection('mysql-backoffice')->table('advs_types-advs')->insert([
                    'adv_id' => $newAdv->id,
                    'adv_type_id' => $request->adv_type_id
                ]);

                return AdvResource::make($newAdv);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $adv
     * @return AdvResource
     */
    public function getAdv($adv)
    {
        $advs = Adv::where([
            'id' => $adv,
            'user_id' => auth()->user()->id
        ])->get();

        return count($advs) > 0 ? new AdvResource($advs[0]) : [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditAdv $request
     * @return array
     */
    public function updateAdv(EditAdv $request)
    {
        if ($request->validated()) {
            $user = auth()->user();

            $updatedAdv = Adv::find([
                'id' => $request->adv,
                'user_id' => $user->id
            ])->first();

            if (!$updatedAdv) {
                throw new NotFoundHttpException('Adv not found');
            }

            if ($user->hasAccess('advs.edit') || ($updatedAdv->user_id == $user->id && $user->hasAccess('advs.edit-own'))) {
                $updatedAdv->update($request->all());

                // Type update too: delete all and write new
                $advModelType = AdvType::where([
                    'adv_id' => $updatedAdv->id
                ])->delete();

                $newAdvType = AdvType::create([
                    'adv_id' => $updatedAdv->id,
                    'adv_type_id' => $request->adv_type_id
                ]);

                // Write all linked sets
                AdvSet::where('adv_id', $updatedAdv->id)->delete();

                $advSet = new AdvSet;
                foreach ($request->sets as $set) {
                    $advSet->adv_id = $updatedAdv->id;
                    $advSet->banner_form_id = $set['banner_form_id'];
                    $advSet->banner_type_id = $set['banner_type_id'];
                    $advSet->container_form_id = $set['container_form_id'];
                    $advSet->container_type_id = $set['container_type_id'];
                    $advSet->alias = $set['alias'];
                    $advSet->save();
                }

                return [
                    'success' => (bool)$updatedAdv,
                    'data' => AdvResource::make($updatedAdv)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Remove the specified adv from storage.
     *
     * @param $adv
     * @return array
     */
    public function deleteAdv($adv)
    {
        $user = auth()->user();

        $advModel = Adv::where([
            'id' => $adv,
            'user_id' => $user->id
        ])->first();

        if (!$advModel) {
            throw new NotFoundHttpException('Adv not found');
        }

        if ($user->hasAccess('advs.delete') || ($advModel->user_id == $user->id && $user->hasAccess('advs.delete-own'))) {
            $answer = AdvResource::make($advModel);
            $advModel->delete();

            // Type delete too
            $advModelType = AdvType::where([
                'adv_id' => $advModel->id
            ])->delete();


            // Linked list of sets delete too
            AdvSet::where('adv_id', $advModel->id)->delete();

            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }

    /**
     * Get default advertise for user
     *
     * @param Request $request
     * @return AdvResource
     */
    public function getDefaultAdv(Request $request)
    {
        $defaultType = AdvType::where('is_default_type', 1)->first();
        if (!$defaultType) {
            throw new Exception(404);
        }

        return new AdvResource(Adv::where([
            'adv_type_id' => $defaultType->id
        ])->first());
    }

    /**
     * Preview Adv by params
     *
     * @param PreviewAdv $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPreview(PreviewAdv $request)
    {
        if ($request->validated()) {
            $advGenerator = new AdvGenerator($request->container_type, $request->container_form, $request->banner_type, $request->banner_form, true);
            return view('adv.preview', [
                'content' => $advGenerator->get(),
                'apiKey' => auth()->user()->api_key
            ]);
        }
    }


    /**
     * @param Requests\ListWebmaster $request
     * @return AnonymousResourceCollection
     */
    public function getAdvGroupListGroupedByAdvertisers(Requests\ListWebmaster $request): AnonymousResourceCollection
    {
        $request->status !== null ? ['sites.status' => $request->status] : [];

        $webmasters = Webmaster::has('sites')->get();

        return WebmasterResource::collection($webmasters);
    }

    /**
     * @param UpdateAdvStatus $request
     * @return array
     */
    public function allow(UpdateAdvStatus $request) : array
    {
        DB::beginTransaction();

        try {
            // 1 make advs allowable
            Adv::whereIn('id', $request['adv_ids'])
                ->update(['status_moderation' => Adv::STATUS_MODERATION_ACTIVE]);

            // 2 add new interests
            $interestIds = $request['exist_interests'];

            foreach ($request['new_interests'] as $interestTitle) {
                $interestTitle = trim($interestTitle);

                if (Interest::where('title', $interestTitle)->first()) {
                    continue;
                }

                $interest        = new Interest;
                $interest->title = $interestTitle;
                $interest->save();

                $interestIds[] = $interest->id;
            }

            // 3.2 set adv-interest relationships
            foreach ($request['adv_ids'] as $advId) {
                foreach ($interestIds as $interestId) {
                    $advInterests[] = [
                        'adv_id'      => $advId,
                        'interest_id' => $interestId
                    ];
                }
            }

            AdvInterest::insert($advInterests);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'errors'  => [
                    $e->getMessage()
                ]
            ];
        }

        return [
            'success' => true
        ];
    }

    /**
     * @param UpdateAdvStatus $request
     * @return array
     */
    public function reject(UpdateAdvStatus $request) : array
    {
        DB::beginTransaction();

        try {
            DB::table('users')->count();

            // 1 make advs reject
            $advsQuery = Adv::whereIn('id', $request['adv_ids']);

            if ($advsQuery->count() != count($request['adv_ids'])) {
                throw new Exception('Trying to reject unexcepted advs.');
            }

            $advsQuery->update(['status_moderation' => Adv::STATUS_MODERATION_REJECTED]);

            // 2 reset all old reasons for those advs
            AdvDenialReason::query()->whereIn('adv_id', $request['adv_ids'])->delete();

            // 3 add reasons for those advs
            foreach ($request['adv_ids'] as $advId) {
                foreach ($request['denial_reason_ids'] as $reasonId) {
                    $advDenialReasons[] = [
                        'adv_id'           => $advId,
                        'denial_reason_id' => $reasonId
                    ];
                }
            }

            AdvDenialReason::insert($advDenialReasons);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'errors'  => [
                    $e->getMessage()
                ]
            ];
        }

        return [
            'success' => true
        ];
    }

    /**
     * @param UpdateAdvStatus $request
     * @return array
     */
    public function block(UpdateAdvStatus $request) : array
    {
        DB::beginTransaction();

        try {
            // 1 make advs blocked
            $advsQuery = Adv::whereIn('id', $request['adv_ids']);

            if ($advsQuery->count() != count($request['adv_ids'])) {
                throw new Exception('Trying to block unexcepted advs.');
            }

            $advsQuery->update(['status_moderation' => Adv::STATUS_MODERATION_BLOCKED]);

            // 2 reset all old reasons for those advs
            AdvDenialReason::query()->whereIn('adv_id', $request['adv_ids'])->delete();

            // 3 add reasons for those advs
            foreach ($request['adv_ids'] as $advId) {
                foreach ($request['denial_reason_ids'] as $reasonId) {
                    $advDenialReasons[] = [
                        'adv_id'           => $advId,
                        'denial_reason_id' => $reasonId
                    ];
                }
            }

            AdvDenialReason::insert($advDenialReasons);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return [
                'success' => false,
                'errors'  => [
                    $e->getMessage()
                ]
            ];
        }

        return [
            'success' => true
        ];
    }
}
