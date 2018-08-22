<?php

namespace App\Http\Controllers\API\Campaign;

use App\Http\Resources\CampaignResource;
use App\Models\Backoffice\Campaign;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Requests\EditCampaign;
use App\Http\Requests\CreateCampaign;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ], [
            'only' => [
                'getAllCampaigns',
                'createCampaign',
                'getCampaign',
                'updateCampaign',
                'deleteCampaign'
            ]
        ]);
    }

    /**
     * Display a listing of the advs
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllCampaigns()
    {
        return CampaignResource::collection(Campaign::all());
    }

    /**
     * Store a newly created resource in storage
     *
     * @param CreateCampaign $request
     * @return CampaignResource
     */
    public function createCampaign(CreateCampaign $request) {
        if($request->validated()) {

            $user = auth()->user();

            if($user->hasAccess('campaigns.create')) {
                $params = $request->all();
                if(!isset($params['budget'])) {
                    $params['budget'] = 0;
                }

                $newCampaign = Campaign::create($params + [
                    'user_id' => $user->id
                ]);

                return CampaignResource::make($newCampaign);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Display the specified resource
     *
     * @param $campaign
     * @return CampaignResource
     */
    public function getCampaign($campaign)
    {
        $campaign = Campaign::where([
            'id' => $campaign,
            'user_id' => auth()->user()->id
        ])->first();

        return $campaign ? new CampaignResource($campaign) : [];
    }

    /**
     * Update the specified resource in storage
     *
     * @param EditCampaign $request
     * @return array
     */
    public function updateCampaign(EditCampaign $request)
    {
        if($request->validated()) {
            $user = auth()->user();

            $updatedCampaign = Campaign::where([
                'id' => $request->campaign,
                'user_id' => $user->id
            ])->first();

            if(!$updatedCampaign) {
                throw new NotFoundHttpException('Campaign not found');
            }

            if($user->hasAccess('campaigns.edit') || ($user->hasAccess('campaigns.edit-own') && $user->id == $updatedCampaign->user_id)) {
                $updatedCampaign->update($request->all());
                return [
                    'success' => (bool)$updatedCampaign,
                    'data' => CampaignResource::make($updatedCampaign)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Remove the specified adv from storage.
     *
     * @param $id
     * @return array
     */
    public function deleteCampaign($id)
    {
        $user = auth()->user();

        $campaignModel = Campaign::find($id);
        if(!$campaignModel) {
            throw new NotFoundHttpException('Campaign not found');
        }

        if($user->hasAccess('campaigns.delete') || ($user->hasAccess('campaigns.delete-own') && $user->id == $campaignModel->user_id)) {
            $answer = CampaignResource::make($campaignModel);
            $campaignModel->delete();
            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }
}
