<?php

namespace App\Http\Controllers\API\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\SiteResource;
use App\Http\Resources\WebmasterResource;
use App\Http\Requests\UpdateSiteStatus;
use App\Models\Backoffice\Interest;
use App\Models\Backoffice\Site;
use App\Models\Backoffice\SiteDenialReason;
use App\Models\Backoffice\SiteInterest;
use App\Models\Backoffice\Webmaster;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
            $siteModel->saveOrFail();

            DB::table('matomo_site')->insert([
                    'idsite' => $siteModel->getAttribute('id'),
                    'name' => $siteModel->getAttribute('url'),
                    'main_url' => $siteModel->getAttribute('url'),
                    'ecommerce' => 1,
                    'sitesearch' => 1,
                    'sitesearch_keyword_parameters' => '',
                    'sitesearch_category_parameters' => '',
                    'timezone' => 'Europe/Moscow',// @todo change
                    'currency' => 'USD',
                    'exclude_unknown_urls' => 0,
                    'excluded_ips' => '',
                    'excluded_parameters' => '',
                    'excluded_user_agents' => '',
                    'group' => '',
                    'type' => 'website',
                    'keep_url_fragment' => 0,
                ]
            );
        }
        return SiteResource::make($siteModel);
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
            DB::table('matomo_site')->delete($site);
            return [
                'success' => (bool) $result,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }

    /**
     * Toggle site status
     *
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
            $siteModel = Site::all()->where('user_id', $user->id);
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

    /**
     * @param Requests\ListWebmaster $request
     * @return AnonymousResourceCollection
     */
    public function getSiteListGroupedByWebmasters(Requests\ListWebmaster $request): AnonymousResourceCollection
    {
        $request->status !== null ? ['sites.status' => $request->status] : [];

        $webmasters = Webmaster::has('sites')->whereHas('sites', function ($query) {
            $query->where('sites.status', Site::STATUS_MODERATION);
        })->get();

        return WebmasterResource::collection($webmasters);
    }

    /**
     * @param UpdateSiteStatus $request
     * @return array
     */
    public function allow(UpdateSiteStatus $request) : array
    {
        DB::beginTransaction();

        try {
            // 1 make sites allowable
            Site::whereIn('id', $request['site_ids'])
                ->update(['status' => Site::STATUS_ACTIVE]);

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

            // 3.2 set site-interest relationships
            foreach ($request['site_ids'] as $siteId) {
                foreach ($interestIds as $interestId) {
                    $siteInterests[] = [
                        'site_id'     => $siteId,
                        'interest_id' => $interestId
                    ];
                }
            }

            SiteInterest::insert($siteInterests);

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
     * @param UpdateSiteStatus $request
     * @return array
     */
    public function reject(UpdateSiteStatus $request) : array
    {
        DB::beginTransaction();

        try {
            // 1 make sites reject
            $siteQuery = Site::whereIn('id', $request['site_ids']);

            if ($siteQuery->count() != count($request['site_ids'])) {
                throw new Exception('Trying to reject unexcepted advs.');
            }

            $siteQuery->update(['status' => Site::STATUS_REJECTED]);

            // 2 reset all old reasons for those sites
            SiteDenialReason::query()->whereIn('site_id', $request['site_ids'])->delete();

            // 3 add reasons for those sites
            foreach ($request['site_ids'] as $siteId) {
                foreach ($request['denial_reason_ids'] as $reasonId) {
                    $siteDenialReasons[] = [
                        'site_id'          => $siteId,
                        'denial_reason_id' => $reasonId
                    ];
                }
            }

            SiteDenialReason::insert($siteDenialReasons);

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
     * @param UpdateSiteStatus $request
     * @return array
     */
    public function block(UpdateSiteStatus $request) : array
    {
        DB::beginTransaction();

        try {
            // 1 make sites blocked
            $siteQuery = Site::whereIn('id', $request['site_ids']);

            if ($siteQuery->count() != count($request['site_ids'])) {
                throw new Exception('Trying to block unexcepted advs.');
            }

            $siteQuery->update(['status' => Site::STATUS_BLOCKED]);

            // 2 reset all old reasons for those sites
            SiteDenialReason::query()->whereIn('site_id', $request['site_ids'])->delete();

            // 3 add reasons for those sites
            foreach ($request['site_ids'] as $siteId) {
                foreach ($request['denial_reason_ids'] as $reasonId) {
                    $siteDenialReasons[] = [
                        'site_id'          => $siteId,
                        'denial_reason_id' => $reasonId
                    ];
                }
            }

            SiteDenialReason::insert($siteDenialReasons);

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
