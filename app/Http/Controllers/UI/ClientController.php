<?php

namespace App\Http\Controllers\UI;


use App\Components\AdvGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\Exception;
use Piwik\Plugins\BulkTracking\Tracker\Requests;
use Storage;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWTAuth;

use App\Models\UI\Site as UISite;

use App\Http\Requests\ClientRequest;
use App\Components\Budgetor;
use Illuminate\Support\Facades\Crypt;

use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Project as UIProject;
use App\Models\UI\Campaign as UICampaign;
use App\Models\UI\Adv as UIAdv;
use App\Models\UI\AdvGroup as UIAdvGroup;


class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('exists-site', [
            'only' => [
                'getClientAdv'
            ]
        ]);
    }

    /**
     * Get rendered adv with container
     *
     * @param ClientRequest $request
     */
    public function getClientAdv(ClientRequest $request) {
        if($request->validated()) {

            // Put +1 show into UI-database
            $this->_putShow($request);


            return [
                'success' => true,
                'rendered' => (new AdvGenerator($request->cont_type, $request->cont_form, null, null, false, $request->language, $request->num_banners))->get()
            ];
        }
    }


    public function putClientClick(Request $request) {
        /**
         * @TODO Here must be special request type for checking, is the banner correct or not. Decrypting can be incorrect, you now.
         */
        $bannerData = explode('|', $this->_getDecryptedBannerId($request->banner_data));
        /**
         * In $bannerData:
         *
         * [
         *      0 => campaign_id
         *      1 => advgroup_id
         *      2 => adv_id
         *      3 => banner_id
         *      4 => project_id
         *      5 => id (PK)
         * ]
         */

        $uiBanner = UIBanner::where(['id' => $bannerData[5]])->first();
        $uiAdv = UIAdv::where(['real_id' => $bannerData[2]])->first();
        $uiAdvGroup = UIAdvGroup::where(['real_id' => $bannerData[1]])->first();
        $uiCampaign = UICampaign::where(['real_id' => $bannerData[0]])->first();
        $uiProject = UIProject::where(['real_id' => $bannerData[4]])->first();

        $budgetor = new Budgetor();
        $budgetor
            ->setBanner($uiBanner)
            ->setAdv($uiAdv)
            ->setAdvGroup($uiAdvGroup)
            ->setCampaign($uiCampaign)
            ->setProject($uiProject)
            ->recalc();

        /**
         * Change all entities
         */
        $uiAdv->num_clicks++;
        $uiAdv->save();

        $uiAdvGroup->num_clicks++;
        $uiAdvGroup->save();

        $uiCampaign->num_clicks++;
        $uiCampaign->save();

        return [
          'success' => true
        ];
    }

    /**
     * Get decrypted banner id
     *
     * @param $idStr
     * @return mixed
     */
    private function _getDecryptedBannerId($idStr) {
        return Crypt::decryptString($idStr);
    }

    /**
     * Put show into database
     */
    private function _putShow($request) {
        $ip = $request->server('REMOTE_ADDR');
        $host = UISite::where([
            'host' => $ip
        ])->first();

        if($host) {
            $host->num_shows++;
            $host->save();
        }
    }
}
