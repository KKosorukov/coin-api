<?php

namespace App\Http\Controllers\API\Adv;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditAdvGroup;
use App\Http\Requests\CreateAdvGroup;
use App\Http\Resources\AdvGroupResource;
use App\Models\Backoffice\AdvGroup;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests\GetByPeriod;

class AdvGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ], [
            'only' => [
                'getAllAdvGroups',
                'getAdvGroupsByCampaignId',
                'createAdvGroup',
                'getAdvGroup',
                'updateAdvGroup',
                'deleteAdvGroup'
            ]
        ]);
    }

    /**
     * Display a listing of the adv groups
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdvGroups(GetByPeriod $request)
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

        $advGroups = AdvGroup::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->get()
            ->reverse();

        return AdvGroupResource::collection($advGroups);
    }

    /**
     * Displays adv groups by campaign ID
     *
     * @param $campaign
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAdvGroupsByCampaignId($campaign) {
        return AdvGroupResource::collection(AdvGroup::where('campaign_id', $campaign)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAdvGroup $request
     * @return AdvGroupResource
     */
    public function createAdvGroup(CreateAdvGroup $request)
    {
        if ($request->validated()) {
            // Dirty hack of: segments param is exists, but "required" is only filled array
            if (auth()->user()->hasAccess('advgroups.create')) {
                $newAdvGroup = AdvGroup::create($request->all() + [
                    'user_id' => auth()->user()->id,
                    'current_budget' => $request->input('budget'),
                    'current_daily_budget' => $request->input('daily_budget')
                ]);

                // Create link between advgroup and segment
                if ($newAdvGroup) {
                    foreach ($request->segments as $segmentId) {
                        DB::connection('mysql-backoffice')->table('segments-adv_groups')->insert([
                            'segment_id' => $segmentId,
                            'adv_group_id' => $newAdvGroup->id
                        ]);
                    }
                } else {
                    abort(404);
                }

                return AdvGroupResource::make($newAdvGroup);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $advgroup
     * @return AdvGroupResource
     */
    public function getAdvGroup($advgroup)
    {
        return new AdvGroupResource(AdvGroup::where([
            'id' => $advgroup,
            'user_id' => auth()->user()->id
        ])->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditAdvGroup $request
     * @return array
     */
    public function updateAdvGroup(EditAdvGroup $request) {
        if ($request->validated()) {
            $user = auth()->user();

            $updatedAdvGroup = AdvGroup::find([
                'id' => $request->advgroup,
                'user_id' => $user->id
            ])->first();

            if (!$updatedAdvGroup) {
                throw new NotFoundHttpException('Adv Group not found');
            }

            if ($user->hasAccess('advgroups.edit') && ($user->hasAccess('advgroups.edit-own') && $user->id == $updatedAdvGroup->user_id)) {
                $updatedAdvGroup->update($request->all());
                return [
                    'success' => (bool)$updatedAdvGroup,
                    'data' => AdvGroupResource::make($updatedAdvGroup)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Remove the specified adv group from storage.
     *
     * @param $advgroup
     * @return array
     */
    public function deleteAdvGroup($advgroup)
    {
        $user = auth()->user();

        $advGroupModel = AdvGroup::where([
            'id' => $advgroup,
            'user_id' => $user->id
        ])->first();

        if (!$advGroupModel) {
            throw new NotFoundHttpException('Adv Group not found');
        }

        if ($user->hasAccess('advgroups.delete') || ($user->id == $advGroupModel->user_id && $user->hasAccess('advgroups.delete-own'))) {

            $answer = AdvGroupResource::make($advGroupModel);
            $advGroupModel->delete();
            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }
}
