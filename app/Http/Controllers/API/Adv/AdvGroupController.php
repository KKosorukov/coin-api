<?php

namespace App\Http\Controllers\API\Adv;

use App\Http\Resources\AdvGroupResource;
use App\Models\Backoffice\AdvGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Requests\EditAdvGroup;
use App\Http\Requests\CreateAdvGroup;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AdvGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => [
                'getAllAdvGroups',
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
    public function getAllAdvGroups()
    {
        return AdvGroupResource::collection(AdvGroup::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAdvGroup $request
     * @return AdvGroupResource
     */
    public function createAdvGroup(CreateAdvGroup $request)
    {
        if($request->validated()) {
            if(auth()->user()->hasAccess('advgroups.create')) {
                $newAdvGroup = AdvGroup::create($request->all() + [
                    'user_id' => auth()->user()->id
                ]);

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
        if($request->validated()) {
            $user = auth()->user();

            $updatedAdvGroup = AdvGroup::find([
                'id' => $request->advgroup,
                'user_id' => $user->id
            ])->first();

            if(!$updatedAdvGroup) {
                throw new NotFoundHttpException('Adv Group not found');
            }

            if($user->hasAccess('advgroups.edit') && ($user->hasAccess('advgroups.edit-own') && $user->id == $updatedAdvGroup->user_id)) {
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

        if($user->hasAccess('advgroups.delete') || ($user->id == $advGroupModel->user_id && $user->hasAccess('advgroups.delete-own'))) {

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
