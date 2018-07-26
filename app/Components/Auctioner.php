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
use App\Models\Backoffice\Site;

use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Campaign as UICampaign;
use App\Models\UI\Container as UIContainer;
use App\Models\UI\Site as UISite;

use App\Components\RandomGenerator;
use Illuminate\Support\Facades\DB;

/**
 * Class provides Auction
 *
 * Class Auctioner
 * @package App\Components
 */

class Auctioner extends Component {

    const NUM_BANNERS = 15;

    private $version = 'v1';

    public function __construct($algorithm = 'simpleRandom', $version = null)
    {
        if($version) {
            $this->version = $version;
        }

        $this->algorithm = $algorithm;

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

        // Move banners with auction
        switch($this->algorithm) {
            case 'simpleRandom' : $this->_chooseRandom(); break;
        }
    }

    /**
     * Drop all
     */
    private function _clear() {
        $this->dropBanners();
        $this->dropCampaigns();
        $this->dropSites();
    }

    /**
     * Get all banners for moving to showcase (advmanager side)
     */
    private function _getBannersForMovingToShowcase() {
        return DB::connection('mysql-backoffice')->table((new Banner)->getTable().' AS t1')
            ->select([
                't1.*',
                't1.title AS banner_title',
                't1.id AS banner_id',
                't2.*',
                't2.text AS adv_text',
                't2.url AS adv_url',
                't3.*',
                't5.*',
                't6.status AS project_status'
            ])
            ->leftJoin((new Adv)->getTable().' AS t2', 't2.id', '=', 't1.adv_id')
            ->leftJoin((new AdvGroup)->getTable().' AS t3', 't3.id', '=', 't2.adv_group_id')
            ->leftJoin((new Campaign)->getTable(). ' AS t5', 't5.id', '=', 't2.campaign_id')
            ->leftJoin((new Project)->getTable(). ' AS t6', 't6.id', '=', 't5.project_id')
            ->where('t5.date_from', '<=', date('Y-m-d h:i:s', time()))
            ->where('t5.date_to', '>=', date('Y-m-d h:i:s', time()))
            ->where('t5.status_moderation', '=', '0')
            ->where('t5.status_global', '=', '0')
            ->where('t5.daily_budget', '>', '0')
            ->where('t6.status', '=', '0') // Project must be enabled
            ->where('t5.status_global', '=', '0') // Campaign must be enabled
            ->where('t3.status', '=', '0') // Adv group must be enabled
            ->where('t2.status_global', '=', '0') // Adv must be enabled
            ->get();
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
     * @return bool
     */
    private function _chooseRandom() {
        $banners = $this->_getBannersForMovingToShowcase();

        $num = count($banners);
        if($num == 0) {
            echo "No banner rows for adding\r\n";
            return true;
        }

        $randomGenerator = new RandomGenerator(0, $num - 1);
        for($i = 0; $i < self::NUM_BANNERS; $i++) {
            $randBannerNumber = $randomGenerator->getRandomNumber();

            $createdBanner = $this->_createBannerRow($banners[$randBannerNumber]);
            $createdCampaigns = $this->_createCampaignRow($banners[$randBannerNumber]);

            if($createdBanner && $createdCampaigns) {
                // @TODO anything
            }
        }

        echo "Success! ".$num." banners rows were added into DB\r\n";
        return;
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
            'date_to' => $campaignFromDb->date_to
        ]);
    }

    /**
     * Create banner row
     *
     * @param $bannerFromDb
     */
    private function _createBannerRow($bannerFromDb) {
        return UIBanner::updateOrCreate([
            'website_id' => 1,
            'campaign_id' => $bannerFromDb->campaign_id,
            'advgroup_id' => $bannerFromDb->adv_group_id,
            'adv_id' => $bannerFromDb->adv_id,
            'banner_id' => $bannerFromDb->banner_id,
            'title' => $bannerFromDb->banner_title,
            'description' => $bannerFromDb->description,
            'path' => $bannerFromDb->path,
            'date_from' => $bannerFromDb->date_from,
            'date_to' => $bannerFromDb->date_to,
            'adv_text' => $bannerFromDb->adv_text,
            'adv_url' => $bannerFromDb->adv_url
        ]);
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
     * Suck all data into backoffice
     */
    public function suckIntoBackoffice() {
        $suckedInBanners = $this->_getBannersForMovingToBackoffice();
        $numBanners = count($suckedInBanners);
        if($numBanners > 0) {
            for ($i = 0; $i < $numBanners; $i++) {
                $this->_updateBackofficeBannersData($suckedInBanners[$i]);
            }

            echo "Success! ".$numBanners." were added to backoffice-database\r\n";
            return;
        }

        echo "No rows for sucking into backoffice-database\r\n";
        return true;
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