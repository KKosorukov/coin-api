<?php

namespace App\Http\Controllers\API\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\SiteResource;
use App\Models\Backoffice\Site;
use Illuminate\Http\JsonResponse;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:api',
            \Barryvdh\Cors\HandleCors::class,
        ]);
    }

    /**
     * @param Requests\CreateSite $request
     * @return SiteResource|JsonResponse
     */
    public function create(Requests\CreateSite $request)
    {
        if ($request->validated()) {
            $user = auth()->user();

            if ($user === null) {
                return $this->returnForbidden();
            }

            $siteModel = new Site();
            $siteModel->fill($request->all());
            $siteModel->setAttribute('user_id', $user->id);
            $siteModel->setAttribute('status', Site::STATUS_MODERATION);
            $siteModel->setAttribute('url', $siteModel->normalizeUrl($request->get('url')));
            $siteModel->save();

            return SiteResource::make($siteModel);
        }
    }

    /**
     * @param $site
     * @return JsonResponse|array
     */
    public function delete($site)
    {
        $user = auth()->user();

        if (/*@todo add role checking*/ $user !== null) {
            $siteModel = Site::where([
                'id' => $site,
                'user_id' => $user->id
            ])->firstOrFail();

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

        if ($user !== null) {

            $siteModel = Site::where([
                'id' => $site,
                'user_id' => $user->id
            ])->firstOrFail();

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
     * @param Requests\EditSite $request
     * @return JsonResponse|array
     */
    public function update(int $site, Requests\EditSite $request)
    {
        if ($request->validated()) {
            $user = auth()->user();

            if ($user !== null) {
                /**
                 * @var Site
                 */
                $siteModel = Site::find([
                    'id' => $site,
                    'user_id' => $user->id
                ])->firstOrFail();

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
    public function list() : array
    {
        $user = auth()->user();

        if ($user !== null) {
            $siteModel = Site::find(['user_id' => $user->id]);
            return [
                'data'  => SiteResource::collection($siteModel),
                'total' => \count($siteModel)
            ];
        }
    }

    /**
     * @param Requests\CheckSite $request
     * @return array
     */
    public function check(Requests\CheckSite $request)
    {
        $user = auth()->user();

        if ($user !== null && $request->validated() /** @todo rbac checking */) {
            /**@todo это явно можно сделать более красивым способом*/
            $normalized_url = (new Site())->normalizeUrl($request->get('url'));
            $file_headers = @get_headers($normalized_url);
            $result = $file_headers !== false && $file_headers[0] !== 'HTTP/1.1 404 Not Found';
            return [
                'success' => $result
            ];
        }
    }
}