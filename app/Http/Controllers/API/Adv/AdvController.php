<?php

namespace App\Http\Controllers\API\Adv;

use App\Components\AdvGenerator;
use App\Http\Resources\AdvResource;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvType;
use App\Models\Backoffice\AdvSet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Requests\EditAdv;
use App\Http\Requests\CreateAdv;
use App\Http\Requests\PreviewAdv;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use DB;

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
    public function getAllAdvs()
    {
        return AdvResource::collection(Adv::all());
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
        return new AdvResource(Adv::where([
            'id' => $adv,
            'user_id' => auth()->user()->id
        ])->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditAdv $request
     * @return array
     */
    public function updateAdv(EditAdv $request)
    {
        if($request->validated()) {
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
                foreach($request->sets as $set) {
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
    public function getDefaultAdv(Request $request) {
        $defaultType = AdvType::where('is_default_type', 1)->first();
        if(!$defaultType) {
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
     */
    public function getPreview(PreviewAdv $request) {
        if($request->validated()) {
            $advGenerator = new AdvGenerator($request->container_type, $request->container_form, $request->banner_type, $request->banner_form, true);
            return view('adv.preview', [
                'content' => $advGenerator->get(),
                'apiKey' => auth()->user()->api_key
            ]);
        }
    }
}
