<?php

namespace App\Http\Controllers\API\Adv;

use App\Http\Resources\AdvResource;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Requests\EditAdv;
use App\Http\Requests\CreateAdv;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AdvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => [
                'getAllAdvs',
                'createAdv',
                'getAdv',
                'updateAdv',
                'deleteAdv'
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
     * Store a newly created resource in storage.
     *
     * @param CreateAdv $request
     * @return AdvResource
     */
    public function createAdv(CreateAdv $request)
    {
        if($request->validated()) {
            $user = auth()->user();

            if($user->hasAccess('adv.create')) {
                $newAdv = Adv::create($request->all() + [
                    'user_id' => $user->id
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

            if ($user->hasAccess('adv.edit') || ($updatedAdv->user_id == $user->id && $user->hasAccess('adv.edit-own'))) {
                $updatedAdv->update($request->all());
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


        if ($user->hasAccess('adv.delete') || ($advModel->user_id == $user->id && $user->hasAccess('adv.delete-own'))) {
            $answer = AdvResource::make($advModel);
            $advModel->delete();
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
}
