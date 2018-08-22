<?php

namespace App\Components;


use App\Models\Backoffice\BannerType;
use App\Models\Backoffice\Campaign;
use App\Models\Backoffice\Container;
use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\Adv;
use App\Models\Backoffice\Banner;
use App\Models\Backoffice\ContainerForm;
use App\Models\Backoffice\ContainerType;
use App\Models\Backoffice\Project;
use App\Models\Backoffice\Segment;
use App\Models\Backoffice\Site;

use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Campaign as UICampaign;
use App\Models\UI\Container as UIContainer;
use App\Models\UI\Site as UISite;
use App\Models\UI\Adv as UIAdv;
use App\Models\UI\AdvGroup as UIAdvGroup;
use App\Models\UI\Project as UIProject;

use App\Components\RandomGenerator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function BenTools\CartesianProduct\cartesian_product;

/**
 * Class provides Auction
 *
 * Class Auctioner
 * @package App\Components
 */

class Auctioner extends Component {

    private $version = 'v1';

    public function __construct($version = null)
    {
        if($version) {
            $this->version = $version;
        }

        parent::__construct();
    }

    /**
     * Run auction
     */
    public function run($clear = false) {
        if($clear) {
            $this->_clear();
        }

        // Move sites to showcase
        $this->_moveSitesToShowcase();

        // Move containers to showcase
        $this->_moveContainersToShowcase();

        // Move advs to showcase
        $this->_moveAdvsToShowcase();

        // Calc showcase
        $this->_calcShowcase();
    }

    /**
     * Normalize K
     *
     * @param $calced
     * @param $maxK
     */
    private function _normalizeK($calced, $maxK) {
        foreach($calced as &$element) {
           $element = $element / $maxK;
        }

        return $calced;
    }

    /**
     * Search maximum K
     *
     * @param $calced
     */
    private function _searchMaxK($calced) {
        $maxK = 0;
        foreach ($calced as $k) {
            if($maxK < $k) {
                $maxK = $k;
            }
        }

        return $maxK;
    }

    /**
     * Move advs to showcase
     */
    public function _moveAdvsToShowcase() {
        $advs = $this->_getAdvsForMovingToShowcase();

        $num = count($advs);
        if($num == 0) {
            echo "No adv rows for adding\r\n";
            return true;
        }

        for($i = 0; $i < $num; $i++) {
            $createdAdv = $this->_createAdvRow($advs[$i]);

            if($createdAdv) {
                // @TODO anything
            }
        }

        echo "Success! ".$num." adv rows were added into DB\r\n";
        return;
    }

    /**
     * Create adv row
     *
     * @param $advFromDb
     */
    private function _createAdvRow($advFromDb) {
        return UIAdv::updateOrCreate([
            'real_id' => $advFromDb->adv_id,
            'banner_form_id' => $advFromDb->adv_type_id,
            'banner_type_id' => -1, // @TODO Type is not for choosing, i think,
            'budget' => $advFromDb->budget,
            'daily_budget' => $advFromDb->daily_budget,
            'status' => $advFromDb->showcase_status,
            'num_shows' => $advFromDb->num_shows,
            'num_clicks' => $advFromDb->num_clicks
        ]);
    }

    /**
     * Get all advs for moving to showcase
     */
    private function _getAdvsForMovingToShowcase() {
        return DB::connection('mysql-backoffice')->table((new Adv)->getTable().' AS t1')
            ->select([
                't2.*',
                't1.*',
                't3.click_price AS click_price'
            ])
            ->join('advs_types-advs AS t2', 't2.adv_id', '=', 't1.id')
            ->join((new AdvGroup)->getTable().' AS t3', 't3.id', '=', 't1.adv_group_id')
            ->join((new Campaign)->getTable(). ' AS t4', 't4.id', '=', 't3.campaign_id')
            ->where('t4.date_from', '<=', Carbon::now())
            ->where('t4.date_to', '>=', Carbon::now())
            ->where('t1.status_global', '=', '0') // Adv must be enabled
            ->where('t4.status_global', '=', '0') // Campaign must be enabled
            ->whereExists(function($query) {
                $query->select([
                    't4.*'
                ])
                ->from((new Banner)->getTable().' AS t4')
                ->whereRaw('t4.adv_id = t1.id');
            })
            ->get();
    }

    /**
     * Drop all
     */
    private function _clear() {
        $this->dropBanners();
        $this->dropCampaigns();
        $this->dropSites();
        $this->dropAdvs();
        $this->dropAdvGroups();
        $this->dropProjects();
    }

    /**
     * Get all banners for moving to showcase (advmanager side)
     */
    private function _getBannersForMovingToShowcase($advIds = []) {
        $bannerQuery = DB::connection('mysql-backoffice')->table((new Banner)->getTable().' AS t1')
            ->select([
                't1.*',
                't1.title AS banner_title',
                't1.id AS banner_id',
                't2.*',
                't2.id AS adv_id',
                't2.short_description AS adv_text_short',
                't2.long_description AS adv_text_long',
                't2.url AS adv_url',
                't3.*',
                't3.id AS advgroup_id',
                't3.budget AS advgroup_budget',
                't3.daily_budget AS advgroup_daily_budget',
                't3.current_budget AS advgroup_current_budget',
                't3.current_daily_budget AS advgroup_current_daily_budget',
                't3.showcase_status AS advgroup_showcase_status',
                't5.*',
                't5.id AS campaign_id',
                't5.budget AS campaign_budget',
                't5.daily_budget AS campaign_daily_budget',
                't5.current_budget AS campaign_current_budget',
                't5.current_daily_budget AS campaign_current_daily_budget',
                't5.showcase_status AS campaign_showcase_status',
                't6.id AS project_id',
                't6.status AS project_status',
                't6.budget AS project_budget',
                't6.daily_budget AS project_daily_budget',
                't6.current_budget AS project_current_budget',
                't6.current_daily_budget AS project_current_daily_budget',
                't6.showcase_status AS project_showcase_status',
                't8.params AS segment_params',
                't8.type AS segment_type',
                't9.banner_form_id',
                't9.banner_type_id',
                't9.container_type_id',
                't9.container_form_id'
            ])
            ->join((new Adv)->getTable().' AS t2', 't2.id', '=', 't1.adv_id')
            ->join((new AdvGroup)->getTable().' AS t3', 't3.id', '=', 't2.adv_group_id')
            ->join((new Campaign)->getTable(). ' AS t5', 't5.id', '=', 't2.campaign_id')
            ->join((new Project)->getTable(). ' AS t6', 't6.id', '=', 't5.project_id')
            ->leftJoin('segments-adv_groups AS t7', 't7.adv_group_id', '=', 't3.id')
            ->leftJoin((new Segment)->getTable().' AS t8', 't8.id', '=', 't7.segment_id')
            ->leftJoin('advs-banner_forms-banner_types AS t9', 't2.id', '=', 't9.adv_id')
            ->where('t5.date_from', '<=', Carbon::now())
            ->where('t5.date_to', '>=', Carbon::now())
            ->where('t5.status_moderation', '=', '0')
            ->where('t5.status_global', '=', '0')
            ->where('t5.daily_budget', '>', '0')
            ->where('t6.status', '=', '0') // Project must be enabled
            ->where('t5.status_global', '=', '0') // Campaign must be enabled
            ->where('t3.status', '=', '0') // Adv group must be enabled
            ->where('t2.status_global', '=', '0'); // Adv must be enabled */

        if(count($advIds) > 0) {
            $bannerQuery->whereIn('t2.id', $advIds);
        }

        return $bannerQuery->get();
    }

    /**
     * Move containers to showcase
     */
    private function _moveContainersToShowcase() {
        $containers = $this->_getContainersForMovingToShowcase();

        $num = count($containers);
        if($num == 0) {
            echo "No container rows for adding\r\n";
            return true;
        }

        for($i = 0; $i < $num; $i++) {
            $createdContainer = $this->_createContainerRow($containers[$i]);

            if($createdContainer) {
                // @TODO anything
            }
        }

        echo "Success! ".$num." containers rows were added into DB\r\n";
        return;
    }

    /**
     * Get sites for moving to showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getSitesForMovingToShowcase() {
        return DB::connection('mysql-backoffice')->table((new Site)->getTable().' AS t1')
            ->select([
                't1.*'
            ])
            ->where('t1.status', '=', '1') // All enabled sites
            ->get();
    }

    /**
     * Move sites to showcase
     */
    private function _moveSitesToShowcase() {
        $sites = $this->_getSitesForMovingToShowcase();

        $num = count($sites);
        if($num == 0) {
            echo "No sites rows for adding\r\n";
            return true;
        }

        for($i = 0; $i < $num; $i++) {
            $createdSiteRow = $this->_createSiteRow($sites[$i]);

            if($createdSiteRow) {
                // @TODO anything
            }
        }

        echo "Success! ".$num." sites rows were added into DB\r\n";
        return;
    }

    /**
     * Get all containers for moving to showcase (webmaster side)
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getContainersForMovingToShowcase() {
        return DB::connection('mysql-backoffice')->table((new Container)->getTable().' AS t1')
            ->select([
                't1.*',
                't2.name AS container_type_name',
                't3.name AS container_form_name',
                't2.classname AS container_type_classname',
                't3.classname AS container_form_classname',
            ])
            ->join((new ContainerType)->getTable().' AS t2', 't2.id', '=', 't1.container_type_id')
            ->join((new ContainerForm)->getTable().' AS t3', 't3.id', '=', 't1.container_form_id')
            ->get();
    }

    /**
     * Get all bannerTypes (places) from backoffice webmaster's side
     *
     * @param $containerId
     * @return \Illuminate\Support\Collection
     */
    private function _getBannerTypesForContainer($containerId) {
        return DB::connection('mysql-backoffice')->table((new BannerType)->getTable().' AS t1')
            ->select([
                't2.*'
            ])
            ->join('banner_types AS t2', 't2.id', '=', 't1.banner_type_id')
            ->where('t1.container_id', '=', $containerId)
            ->get();
    }


    /**
     * @return bool
     */
    private function _calcShowcase() {
        $advs = $this->_getAdvsForMovingToShowcase();
        $numAdvs = count($advs);

        $calced = [];
        foreach ($advs as $adv) {
            $k = (1 / 6) * $adv->click_price * $adv->num_clicks * $adv->num_shows;
            $calced[(string)$adv->id] = $k;
        }

        $maxK = $this->_searchMaxK($calced);
        $calced = $this->_normalizeK($calced, $maxK);

        if(count($calced) > 0) {
            $averageK = 1 / count($calced); // We normalized all k to 1...
        } else {
            $averageK = 0.5; // If no advs
        }

        uasort($calced, function($one, $two) {
            if($one < $two) {
                return -1;
            }

            if($one > $two)  {
                return 1;
            }

            return 0;
        });

        // Already sorted array...
        $advIds = [];
        foreach ($calced as $advId => $idElement) {
            $advIds[] = $advId;
        }

        $banners = $this->_getBannersForMovingToShowcase($advIds);

        if(count($banners) == 0) {
            echo "No banner rows for adding\r\n";
            return true;
        }

        $numBanners = 0;
        foreach($banners as $banner) {
            if($banner->num_shows == 0) { // First created adv...
                $weight = $averageK;
            } else {
                $weight = $calced[$banner->adv_id];
            }


            $createdBanners = $this->_createBannerRow($banner, $weight);
            $numBanners += $createdBanners['numBanners'];

            $createdCampaigns = $this->_createCampaignRow($banner);
            $createdAdvgroups = $this->_createAdvGroupRow($banner);
            $createdProjects = $this->_createProjectRow($banner);

            echo "Probability for banner for adv id [" .$banner->adv_id. "] = ".$calced[$banner->adv_id]."\r\n";

            if($createdBanners && $createdCampaigns && $createdAdvgroups && $createdProjects) {

            }
            // @TODO: Correct calculations of operations
        }

        echo "Success! ".$numBanners." banners rows were added into DB\r\n";
        return;
    }


    /**
     * Create advgroup row in showcase
     *
     * @param $advGroupFromDb
     */
    private function _createAdvGroupRow($advGroupFromDb) {
        return UIAdvGroup::updateOrCreate([
            'real_id' => $advGroupFromDb->advgroup_id,
            'daily_budget' => $advGroupFromDb->daily_budget,
            'budget' => $advGroupFromDb->budget,
            'current_daily_budget' => $advGroupFromDb->current_daily_budget,
            'current_budget' => $advGroupFromDb->current_budget,
            'click_price' => $advGroupFromDb->click_price,
            'status' => $advGroupFromDb->advgroup_showcase_status,
        ]);
    }

    /**
     * Create project row in showcase
     *
     * @param $projectRowFromDb
     */
    private function _createProjectRow($projectRowFromDb) {
        return UIProject::updateOrCreate([
            'real_id' => $projectRowFromDb->project_id,
            'daily_budget' => $projectRowFromDb->daily_budget,
            'budget' => $projectRowFromDb->budget,
            'current_daily_budget' => $projectRowFromDb->current_daily_budget,
            'current_budget' => $projectRowFromDb->current_budget,
            'status' => $projectRowFromDb->project_showcase_status
        ]);
    }

    /**
     * Create campaign in showcase
     *
     * @param $campaignFromDb
     */
    private function _createCampaignRow($campaignFromDb) {
        return UICampaign::updateOrCreate([
            'real_id' => $campaignFromDb->campaign_id,
            'daily_budget' => $campaignFromDb->daily_budget,
            'date_from' => $campaignFromDb->date_from,
            'date_to' => $campaignFromDb->date_to,
            'budget' => $campaignFromDb->budget,
            'current_daily_budget' => $campaignFromDb->current_daily_budget,
            'current_budget' => $campaignFromDb->current_budget,
            'status' => $campaignFromDb->campaign_showcase_status
        ]);
    }

    /**
     * Create banner row
     *
     * @param $bannerFromDb
     */
    private function _createBannerRow($bannerFromDb, $probability) {
        $bannerMap = $this->_generateBannerMap($bannerFromDb, $probability);
        $bannersCollection = [];
        foreach ($bannerMap as $element) {
            $bannersCollection[] = UIBanner::updateOrCreate($element);
        }

        return [
            'numBanners' => count($bannersCollection),
            'collection' => $bannersCollection
        ];
    }

    /**
     * Generate cartesian product of map
     *
     * @param $bannerFromDb
     * @return array
     */
    private function _generateBannerMap($bannerFromDb, $probability) {
        $fields = [
            'website_id' => 1,
            'project_id' => $bannerFromDb->project_id,
            'campaign_id' => $bannerFromDb->campaign_id,
            'advgroup_id' => $bannerFromDb->adv_group_id,
            'adv_id' => $bannerFromDb->adv_id,
            'banner_id' => $bannerFromDb->banner_id,
            'title' => $bannerFromDb->banner_title,
            'description' => $bannerFromDb->description,
            'path' => $bannerFromDb->path,
            'date_from' => $bannerFromDb->date_from,
            'date_to' => $bannerFromDb->date_to,
            'adv_short_desc' => $bannerFromDb->adv_text_short,
            'adv_long_desc' => $bannerFromDb->adv_text_long,
            'adv_url' => $bannerFromDb->adv_url,
            'additional_adv_url_1' => $bannerFromDb->additional_adv_url_1,
            'additional_adv_url_2' => $bannerFromDb->additional_adv_url_2,
            'additional_adv_url_3' => $bannerFromDb->additional_adv_url_3,
            'additional_adv_url_4' => $bannerFromDb->additional_adv_url_4,
            'additional_adv_url_desc_1' => $bannerFromDb->additional_adv_url_desc_1,
            'additional_adv_url_desc_2' => $bannerFromDb->additional_adv_url_desc_2,
            'additional_adv_url_desc_3' => $bannerFromDb->additional_adv_url_desc_3,
            'additional_adv_url_desc_4' => $bannerFromDb->additional_adv_url_desc_4,
            'banner_form_id' => $bannerFromDb->banner_form_id,
            'banner_type_id' => $bannerFromDb->banner_type_id,
            'container_form_id' => $bannerFromDb->container_form_id,
            'container_type_id' => $bannerFromDb->container_type_id,
            'probability' => $probability
        ];


        $additionalFields = [];
        if($bannerFromDb->segment_params) { // != null. Targeting params are optional.
            $jsonParams = json_decode($bannerFromDb->segment_params, true);
            $additionalFields = cartesian_product($jsonParams['params'])->asArray();
        }

        $resultData = [];
        if(count($additionalFields) > 0) {
            foreach ($additionalFields as $variant) {
                $resultData[] = $fields + $variant['geo'] + $variant['time'] + ['browser_language' => $variant['language']];
            }
        } else {
            $resultData[] = $fields;
        }

        return $resultData;
    }

    /**
     * Create site row
     *
     * @param $siteFromDb
     */
    private function _createSiteRow($siteFromDb) {
        return UISite::updateOrCreate([
            'user_id' => $siteFromDb->user_id,
            'url' => $siteFromDb->url,
            'host' => $siteFromDb->host,
            'is_text' => $siteFromDb->is_text,
            'is_banner' => $siteFromDb->is_banner,
            'is_video' => $siteFromDb->is_video,
            'balance' => $siteFromDb->balance,
            'status' => $siteFromDb->status
        ]);
    }

    /**
     * Create container row
     *
     * @param $bannerFromDb
     * @return mixed
     */
    private function _createContainerRow($containerFromDb) {
        return UIContainer::updateOrCreate([
            'user_id' => $containerFromDb->user_id,
            'width' => $containerFromDb->width,
            'height' => $containerFromDb->height,
            'container_type_id' => $containerFromDb->container_type_id,
            'container_form_id' => $containerFromDb->container_form_id,
            'container_type_name' => $containerFromDb->container_type_name,
            'container_form_name' => $containerFromDb->container_form_name,
            'container_type_classname' => $containerFromDb->container_type_classname,
            'container_form_classname' => $containerFromDb->container_form_classname,
            'num_banners' => $containerFromDb->num_banners
        ]);
    }

    /**
     * Drop old banners from table
     */
    public function dropOld() {
        DB::connection('mysql-ui')->table((new Banner)->getTable())->where('date_to', '<=', date('Y-m-d h:i:s', time()))->delete();
        echo "Success!\r\n";
        return true;
    }

    /**
     * Clean sites table
     */
    private function dropSites() {
        DB::connection('mysql-ui')->table((new UISite)->getTable())->truncate();
    }

    /**
     * Clean campaigns table
     */
    private function dropCampaigns() {
        DB::connection('mysql-ui')->table((new UICampaign)->getTable())->truncate();
    }

    /**
     * Clean banners table
     */
    private function dropBanners() {
        DB::connection('mysql-ui')->table((new UIBanner)->getTable())->truncate();
    }

    /**
     * Clean advs table
     */
    private function dropAdvs() {
        DB::connection('mysql-ui')->table((new UIAdv)->getTable())->truncate();
    }

    /**
     * Clean advgroups table
     */
    private function dropAdvGroups() {
        DB::connection('mysql-ui')->table((new UIAdvGroup)->getTable())->truncate();
    }

    /**
     * Clean projects table
     */
    private function dropProjects() {
        DB::connection('mysql-ui')->table((new Project)->getTable())->truncate();
    }

    /**
     * Suck all data into backoffice
     */
    public function suckIntoBackoffice() {
        $this->_suckBannersIntoBackoffice();
        $this->_suckAdvsIntoBackoffice();
        $this->_suckCampaignsIntoBackoffice();
        $this->_suckProjectsIntoBackoffice();
        $this->_suckAdvGroupsIntoBackoffice();
    }

    /**
     * Suck banners into backoffice-db
     *
     * @return bool|void
     */
    private function _suckBannersIntoBackoffice() {
        $suckedInBanners = $this->_getBannersForMovingToBackoffice();
        $numBanners = count($suckedInBanners);
        if($numBanners > 0) {
            for ($i = 0; $i < $numBanners; $i++) {
                $this->_updateBackofficeBannersData($suckedInBanners[$i]);
            }

            echo "Success! ".$numBanners." banners were added to backoffice-database\r\n";
            return;
        }

        echo "No banner rows for sucking into backoffice-database\r\n";
        return true;
    }

    /**
     * Suck advs into backoffice-db
     *
     * @return bool|void
     */
    private function _suckAdvsIntoBackoffice() {
        $suckedInAdvs = $this->_getAdvsForMovingToBackoffice();
        $numAdvs = count($suckedInAdvs);

        $this->_deleteOutworkedAdvs();

        if($numAdvs > 0) {
            for ($i = 0; $i < $numAdvs; $i++) {
                $this->_updateBackofficeAdvsData($suckedInAdvs[$i]);
            }

            echo "Success! ".$numAdvs." advs were added to backoffice-database\r\n";
            return;
        }

        echo "No adv rows for sucking into backoffice-database\r\n";
        return true;
    }


    /**
     * Suck campaigns into backoffice-db
     *
     * @return bool|void
     */
    private function _suckCampaignsIntoBackoffice() {
        $suckedInCampaigns = $this->_getCampaignsForMovingToBackoffice();
        $numCampaigns = count($suckedInCampaigns);

        $this->_deleteOutworkedCampaigns();

        if($numCampaigns > 0) {
            for ($i = 0; $i < $numCampaigns; $i++) {
                $this->_updateBackofficeCampaignsData($suckedInCampaigns[$i]);
            }

            echo "Success! ".$numCampaigns." campaigns were updated in backoffice-database\r\n";
            return;
        }

        echo "No campaign rows for sucking into backoffice-database\r\n";
        return true;
    }

    /**
     * Suck projects into backoffice-db
     *
     * @return bool|void
     */
    private function _suckProjectsIntoBackoffice() {
        $suckedInProjects = $this->_getProjectsForMovingToBackoffice();
        $numProjects = count($suckedInProjects);

        $this->_deleteOutworkedProjects();

        if($numProjects > 0) {
            for ($i = 0; $i < $numProjects; $i++) {
                $this->_updateBackofficeProjectsData($suckedInProjects[$i]);
            }

            echo "Success! ".$numProjects." projects were updated in backoffice-database\r\n";
            return;
        }

        echo "No project rows for sucking into backoffice-database\r\n";
        return true;
    }

    /**
     * Suck advGroups into backoffice-db
     *
     * @return bool|void
     */
    private function _suckAdvGroupsIntoBackoffice() {
        $suckedInAdvGroups = $this->_getAdvGroupsForMovingToBackoffice();
        $numAdvGroups = count($suckedInAdvGroups);

        $this->_deleteOutworkedAdvGroups();

        if($numAdvGroups > 0) {
            for ($i = 0; $i < $numAdvGroups; $i++) {
                $this->_updateBackofficeAdvGroupsData($suckedInAdvGroups[$i]);
            }

            echo "Success! ".$numAdvGroups." advGroups were updated in backoffice-database\r\n";
            return;
        }

        echo "No advGroup rows for sucking into backoffice-database\r\n";
        return true;
    }

    /**
     * Get projects data for moving to backoffice, from showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getProjectsForMovingToBackoffice() {
        return DB::connection('mysql-ui')->table((new UIProject)->getTable().' AS t1')
            ->select([
                't1.*',
            ])
           /* ->where('t1.current_budget', '=', 0)
            ->orWhere('t1.current_daily_budget', '=', 0) */
            ->get();
    }

    /**
     * Delete non-budgetted campaigns
     */
    private function _deleteOutworkedProjects() {

        // If current budget = 0, there are no reasons to keep this in showcase...
        DB::connection('mysql-ui')->table((new UIProject)->getTable())
            ->where('current_budget', '=', 0)
            ->delete();
    }


    /**
     * Move projects stat from UI to backoffice
     *
     * @param $projectFromUI
     */
    private function _updateBackofficeProjectsData($projectFromUI) {
        $backofficeProject = Project::find($projectFromUI->real_id);
        if($backofficeProject) {
            $backofficeProject->current_daily_budget = $projectFromUI->current_daily_budget;
            $backofficeProject->current_budget = $projectFromUI->current_budget;
            $backofficeProject->showcase_status = $projectFromUI->status;
            $backofficeProject->save();
            return true;
        }

        return false;
    }


    /**
     * Get adv data for moving to backoffice, from showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getAdvsForMovingToBackoffice() {
        $answer = DB::connection('mysql-ui')->table((new UIAdv)->getTable().' AS t1')
            ->select([
                't1.*',
            ])
           /* ->where('t1.current_budget', '=', 0)
            ->orWhere('t1.current_daily_budget', '=', 0) */
            ->get();


        return $answer;
    }

    /**
     * Delete non-budgetted advs
     */
    private function _deleteOutworkedAdvs() {

        // If current budget = 0, there are no reasons to keep this in showcase...

        DB::connection('mysql-ui')->table((new UIAdv)->getTable())
            ->where('current_budget', '=', 0)
            ->delete();
    }


    /**
     * Move adv stat from UI to backoffice
     *
     * @param $advFromUI
     */
    private function _updateBackofficeAdvsData($advFromUI) {
        $backofficeAdv = Adv::find($advFromUI->real_id);
        if($backofficeAdv) {
            $backofficeAdv->current_daily_budget = $advFromUI->current_daily_budget;
            $backofficeAdv->current_budget = $advFromUI->current_budget;
            $backofficeAdv->showcase_status = $advFromUI->status;
            $backofficeAdv->num_shows = $advFromUI->num_shows;
            $backofficeAdv->num_clicks = $advFromUI->num_clicks;
            $backofficeAdv->save();
            return true;
        }

        return false;
    }


    /**
     * Get advGroups data for moving to backoffice, from showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getAdvGroupsForMovingToBackoffice() {
        return DB::connection('mysql-ui')->table((new UIAdvGroup)->getTable().' AS t1')
            ->select([
                't1.*',
            ])
            /* ->where('t1.current_budget', '=', 0)
            ->orWhere('t1.current_daily_budget', '=', 0) */
            ->get();
    }

    /**
     * Delete non-budgetted advgroups
     */
    private function _deleteOutworkedAdvGroups() {

        // If current budget = 0, there are no reasons to keep this in showcase...

        DB::connection('mysql-ui')->table((new UIAdvGroup)->getTable())
            ->where('current_budget', '=', 0)
            ->delete();
    }

    /**
     * Move advGroup stat from UI to backoffice
     *
     * @param $advGroupFromUI
     */
    private function _updateBackofficeAdvGroupsData($advGroupFromUI) {
        $backofficeAdvGroup = AdvGroup::find($advGroupFromUI->real_id);
        if($backofficeAdvGroup) {
            $backofficeAdvGroup->current_daily_budget = $advGroupFromUI->current_daily_budget;
            $backofficeAdvGroup->current_budget = $advGroupFromUI->current_budget;
            $backofficeAdvGroup->showcase_status = $advGroupFromUI->status;
            $backofficeAdvGroup->save();
            return true;
        }

        return false;
    }

    /**
     * Get campaign data for moving to backoffice, from showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getCampaignsForMovingToBackoffice() {
        return DB::connection('mysql-ui')->table((new UICampaign)->getTable().' AS t1')
            ->select([
                't1.*',
            ])
           /* ->where('t1.current_budget', '=', 0)
            ->orWhere('t1.current_daily_budget', '=', 0) */
            ->get();
    }

    /**
     * Delete non-budgetted campaigns
     */
    private function _deleteOutworkedCampaigns() {

        // If current budget = 0, there are no reasons to keep this in showcase...

        DB::connection('mysql-ui')->table((new UICampaign)->getTable())
            ->where('current_budget', '=', 0)
            ->delete();
    }

    /**
     * Move campaign stat from UI to backoffice
     *
     * @param $campaignFromUI
     */
    private function _updateBackofficeCampaignsData($campaignFromUI) {
        $backofficeCampaign = Campaign::find($campaignFromUI->real_id);
        if($backofficeCampaign) {
            $backofficeCampaign->current_daily_budget = $campaignFromUI->current_daily_budget;
            $backofficeCampaign->current_budget = $campaignFromUI->current_budget;
            $backofficeCampaign->showcase_status = $campaignFromUI->status;
            $backofficeCampaign->save();
            return true;
        }

        return false;
    }


    /**
     * Get data for moving to backoffice, from showcase
     *
     * @return \Illuminate\Support\Collection
     */
    private function _getBannersForMovingToBackoffice() {
        return DB::connection('mysql-ui')->table((new UIBanner)->getTable().' AS t1')
            ->select([
                't1.*',
                't2.*'
            ])
            ->join((new UICampaign)->getTable().' AS t2', 't2.real_id', '=', 't1.campaign_id')
            ->where('t1.date_to', '<=', date('Y-m-d h:i:s', time()))
            ->get();
    }

    /**
     * Move banner stat from UI to backoffice
     *
     * @param $bannerFromUI
     */
    private function _updateBackofficeBannersData($bannerFromUI) {
        $backofficeBanner = Banner::find($bannerFromUI->banner_id);
        if($backofficeBanner) {
            // @TODO Here is a stat from UI
            return true;
        }

        return false;
    }
}