<?php

namespace App\Components;

use App\Models\Backoffice\Container;
use App\Models\Backoffice\ContainerForm;
use App\Models\Backoffice\ContainerType;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Storage;
use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Container as UIContainer;
use Illuminate\Support\Facades\DB;

use App\Models\Backoffice\BannerForms\Carousel;
use App\Models\Backoffice\BannerForms\Simple;
use App\Models\Backoffice\BannerForms\ThreeInRow;
use App\Models\Backoffice\BannerForms\TwoInRow;

use GeoIp2\Database\Reader;

use App\Models\UI\Campaign as UICampaign;
use App\Models\UI\Adv as UIAdv;
use App\Models\UI\AdvGroup as UIAdvGroup;
use App\Models\UI\Project as UIProject;


/**
 * Class provides adv generation on client
 *
 * Class AdvGenerator
 * @package App\Components
 */

class AdvGenerator extends Component {
    private $contType; // Container type: vertical, horizontal...
    private $contForm; // Container form: inline, popup...
    private $bannerType; // Banner type: image, video, text..
    private $bannerForm; // Banner form: carousel, simple, three in row...
    private $getDummy; // Is this adv dummy or not?
    private $maxBanners = 3; // Max banners per container

    public function __construct($contType = null, $contForm = null, $bannerType = null, $bannerForm = null, $getDummy = false)
    {
        $this->contType = $contType;
        $this->contForm = $contForm;
        $this->bannerType = $bannerType;
        $this->bannerForm = $bannerForm;
        $this->getDummy = $getDummy;

        parent::__construct();
    }

    /**
     * Choose container for banners
     */
    private function _chooseContainer() {
        if($this->getDummy) {
            $containerQuery = DB::connection('mysql-backoffice')->table((new Container)->getTable() . ' AS t1')
                ->select([
                    't1.*',
                    't2.name AS container_type_name',
                    't3.name AS container_form_name'
                ])
                ->join((new ContainerType)->getTable() . ' AS t2', 't1.container_type_id', '=', 't2.id')
                ->join((new ContainerForm)->getTable() . ' AS t3', 't1.container_form_id', '=', 't3.id');
        } else {
            $containerQuery = DB::connection('mysql-ui')->table((new UIContainer)->getTable() . ' AS t1')
                ->select([
                    't1.*'
                ]);
        }

        if($this->contType) {
            if($this->getDummy) {
                $containerQuery->where('t2.id', '=', $this->contType);
            } else {
                $containerQuery->where('t1.container_type_name', '=', $this->contType);
            }
        }

        if($this->contForm) {
            if($this->getDummy) {
                $containerQuery->where('t3.id', '=', $this->contForm);
            } else {
                $containerQuery->where('t1.container_form_name', '=', $this->contForm);
            }
        }

        return $this->getDummy ? [$containerQuery->first()] : $containerQuery->inRandomOrder()->get();
    }

    /**
     * Choose bannners for container
     */
    private function _chooseBanners($numBanners) {
        $randomGenerator = new RandomGenerator();

        $bannerQuery = DB::connection('mysql-ui')->table((new UIBanner)->getTable().' AS t1')
            ->select([
                't1.*',
                't3.status AS adv_status',
                't4.status AS advgroup_status',
                't5.status AS campaign_status',
                't6.status AS project_status',
            ])
            ->join((new UIAdv)->getTable().' AS t3', 't3.real_id', '=', 't1.adv_id')
            ->join((new UIAdvGroup)->getTable().' AS t4', 't4.real_id', '=', 't1.advgroup_id')
            ->join((new UICampaign)->getTable(). ' AS t5', 't5.real_id', '=', 't1.campaign_id')
            ->join((new UIProject)->getTable(). ' AS t6', 't6.real_id', '=', 't1.project_id');

        $this->_addGeoLocation($bannerQuery); // @TODO Comment or uncomment this for tests
        $this->_addTimeLinking($bannerQuery);
        $this->_addBrowserLanguage($bannerQuery);

        if($this->bannerForm || $this->bannerType) {
            $bannerQuery->join('advs_types-advs t2', 't2.adv_id', '=', 't1.adv_id');
        }

        if($this->bannerType) {
            $bannerQuery->where('t2.banner_type_id', '=', $this->bannerType);
        }

        if($this->bannerForm) {
            $bannerQuery->where('t2.banner_form_id', '=', $this->bannerForm);
        }

        $queryResult = $bannerQuery
                    ->where('t3.status', '=', 0)
                    ->where('t4.status', '=', 0)
                    ->where('t5.status', '=', 0)
                    ->where('t6.status', '=', 0)
                    ->get();

        return $this->_rollTheDice($queryResult);
    }

    /**
     * Roll the dice about banners choose
     *
     * @param $queryResult
     */
    private function _rollTheDice($queryResult) {
        $num = count($queryResult);
        $limit = 0;
        $intervals = [];
        for($i = 0; $i < $num; $i++) {
            $intervals[$i] = [
                'from' => $limit,
                'id' => $queryResult[$i]->id
            ];

            $limit += $queryResult[$i]->probability;

            $intervals[$i]['to'] = $limit;
        }

        $generator = new RandomGenerator();
        $banners = [];
        for($i = 0; $i < $this->maxBanners; $i++) {
            $randIndex = floor($generator->getRandomFloat() * $limit);
            $banners[$i] = $queryResult[$randIndex];
        }

        return $banners;
    }

    /**
     * Get default banner for "lorem ipsum" preview :) 3 maximum.
     */
    private function _getDummyBanners() {
        $dummyBanner = \App\Models\Backoffice\Banner::where(['id' => 0])->first();
        $res = [];
        for($i = 0; $i < 3; $i++) {
            $res[] = $dummyBanner;
        }

        return $res;
    }

    /**
     * Time filter according to query
     *
     * @param $bannerQuery
     */
    private function _addTimeLinking($bannerQuery) {

    }

    /**
     * Add browser's language filter
     *
     * @param $bannerQuery
     */
    private function _addBrowserLanguage($bannerQuery, $userLanguage) {
        $bannerQuery->whereIn('t1.browser_language', [$userLanguage, null]);
    }

    /**
     * Add geolocation params to choosing
     *
     * @param $bannerQuery
     * @throws \GeoIp2\Exception\AddressNotFoundException
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    private function _addGeoLocation($bannerQuery) {
        $record = $this->_getGeoRecord();
        if($record->country->isoCode) { // Country targeting
            $bannerQuery->whereIn('t1.country_code', [$record->country->isoCode, null]);
        }
        if($record->mostSpecificSubdivision->isoCode) { // Area targeting
            $bannerQuery->where('t1.area_code', [$record->mostSpecificSubdivision->isoCode, null]);
        }
    }

    /**
     * Get geotargeting record
     *
     * @return \GeoIp2\Model\City
     * @throws \GeoIp2\Exception\AddressNotFoundException
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    private function _getGeoRecord() {
        $reader = new Reader(Storage::path(env('MAXMIND_DB_FILE')));

        $ip = $_SERVER['REMOTE_ADDR'];
        if($ip == '127.0.0.1') {
            return $reader->city('87.250.250.242'); // Return yandex test..
        }

        return $reader->city($ip);
    }

    /**
     * Get mix of all params
     *
     * @return mixed
     */
    public function get() {
        // Choose container...
        $container = $this->_chooseContainer();

        if(count($container) == 0) {
            return '';
        }

        // If this is dummy, banner should be "default"
        if($this->getDummy) {
            $banners = $this->_getDummyBanners();
        } else { // Real world
            // Choose banners for containers...
            $banners = $this->_chooseBanners($container[0]->num_banners);
        }

        if(count($banners) > 0) {
            // Let container display banners
            if($this->getDummy) {
                $containerForm = ContainerForm::find($this->contForm);
                if(!$containerForm) {
                    abort(404);
                }

                $containerType = ContainerType::find($this->contType);
                if(!$containerType) {
                    abort(404);
                }

                return $this->mix(
                    new $containerType->classname,
                    new $containerForm->classname,
                    $banners,
                    $container[0]
                );

            } else {
                return $this->mix(
                    new $container[0]->container_type_classname($container[0]),
                    new $container[0]->container_form_classname($container[0]),
                    $banners,
                    $container[0]
                );
            }
        }

        return 'No banners yet';
    }


    /**
     * Mix of all params for display
     *
     * @param $containerType
     * @param $containerForm
     * @param $banners
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function mix($containerType, $containerForm, $banners, $container) {
        // $randomBannerForm = $this->_getRandomBannerForm();
        $bannerForm = $this->_getBannerForm($container);

        return $containerForm->getRenderedView([
            'content' => $containerType->getRenderedView([
                // 'content' => (new $randomBannerForm($container, $banners))->getRenderedView()
                'content' => (new $bannerForm($container, $banners))->getRenderedView()
            ])
        ]);
    }

    /**
     * Get random banner form
     *
     * @return mixed
     */
    private function _getRandomBannerForm() {
        $bannerForms = [
            //Carousel::class,
            Simple::class,
            TwoInRow::class,
            ThreeInRow::class
        ];

        $randForm = (new RandomGenerator(0, count($bannerForms) - 1))->getRandomNumber();

        return $bannerForms[$randForm];
    }

    /**
     * Get banner form for container
     */
    private function _getBannerForm($container) {
        $bannerForms = [
            Simple::class,
            TwoInRow::class,
            ThreeInRow::class
        ];

        if($container->num_banners > 3) {
            $index = 2;
        } else {
            $index = $container->num_banners - 1;
        }

        return $bannerForms[$index];
    }
}