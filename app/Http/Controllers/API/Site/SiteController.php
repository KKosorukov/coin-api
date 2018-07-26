<?php

namespace App\Http\Controllers\API\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSite;
use App\Http\Requests\EditSite;
use App\Http\Resources\SiteResource;
use App\Models\Backoffice\Site;
use Illuminate\Http\JsonResponse;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(CreateSite $request)
    {
        if ($request->validated()) {
            $user = auth()->user();

            if (/*@todo add role checking*/ true) {
                $siteModel = Site::create($request->all());
                $siteModel->user_id = $user->id;
                return SiteResource::make($siteModel);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * @param $site
     * @return JsonResponse|array
     */
    public function delete($site)
    {
        $user = auth()->user();

        $siteModel = Site::where([
            'id' => $site,
            'user_id' => $user->id
        ])->firstOrFail();

        if (/*@todo add role checking*/ true) {
            /**
             * @var SiteResource $answer
             */
            $answer = SiteResource::make($siteModel);
            $result = $siteModel->delete();
            return [
                'success' => (bool) $result,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }

    /**
     * @param $site
     * @return JsonResponse
     * @throws \Exception
     */
    public function toggle($site)
    {
        $user = auth()->user();

        $siteModel = Site::where([
            'id' => $site,
            'user_id' => $user->id
        ])->firstOrFail();

        if (/*@todo add role checking*/ true) {
            switch ($siteModel->status) {
                case Site::STATUS_ACTIVE:
                    $siteModel->status = Site::STATUS_STOPPED;
                    break;
                case Site::STATUS_STOPPED:
                    $siteModel->status = Site::STATUS_ACTIVE;
                    break;
                default:
                    /** @todo change exception */
                    throw new \Exception("Can't toggle from current status");
                    break;
            }
        } else {
            return $this->returnForbidden();
        }
    }

    /**
     * @param integer $site
     * @param EditSite $request
     * @return JsonResponse|array
     */
    public function update(int $site, EditSite $request)
    {
        if ($request->validated()) {
            $user = auth()->user();

            /**
             * @var Site
             */
            $siteModel = Site::find([
                'id' => $site,
                'user_id' => $user->id
            ])->firstOrFail();

            if (/*@todo add role checking*/ true) {
                $siteModel->update($request->all());
                return [
                    'success' => (bool)$siteModel,
                    'data' => SiteResource::make($siteModel)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * @return array
     */
    public function list()
    {
        $user = auth()->user();

        $siteModel = Site::find(['user_id' => $user->id])->all();
        return $siteModel;
    }
}