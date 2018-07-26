<?php

namespace App\Components;

use App\Models\Backoffice\Container;
use App\Models\Backoffice\ContainerForm;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Storage;
use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Container as UIContainer;
use Illuminate\Support\Facades\DB;

use App\Models\Backoffice\BannerForms\Carousel;
use App\Models\Backoffice\BannerForms\Simple;
use App\Models\Backoffice\BannerForms\ThreeInRow;


/**
 * Class provides adv generation on client
 *
 * Class AdvGenerator
 * @package App\Components
 */

class AdvGenerator extends Component {
    private $contType; // Container type: vertical, horizontal...
    private $contForm; // Container form: inline, popup...

    public function __construct($contType = null, $contForm = null, $bannerType = null, $bannerForm = null)
    {
        $this->contType = $contType;
        $this->contForm = $contForm;
        $this->bannerType = $bannerType;
        $this->bannerForm = $bannerForm;

        parent::__construct();
    }

    /**
     * Choose container for banners
     */
    private function _chooseContainer() {
        $containerQuery = DB::connection('mysql-ui')->table((new UIContainer)->getTable().' AS t1')
            ->select([
                't1.*'
            ]);

        if($this->contType) {
            $containerQuery->where('t1.container_type_name', '=', $this->contType);
        }

        if($this->contForm) {
            $containerQuery->where('t1.container_form_name', '=', $this->contForm);
        }

        return $containerQuery->inRandomOrder()->get();
    }

    /**
     * Choose bannners for container
     */
    private function _chooseBanners($numBanners) {
        $bannerQuery = DB::connection('mysql-ui')->table((new UIBanner)->getTable().' AS t1')
            ->select([
                't1.*'
            ]);

        if($this->bannerType) {
            // @TODO
        }
        if($this->bannerForm) {
            // @TODO
        }

        return $bannerQuery->limit($numBanners)->offset(0)->inRandomOrder()->get();
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

        // Choose banners for containers...
        $banners = $this->_chooseBanners($container[0]->num_banners);

        // Let container display banners
        return $this->mix(
            new $container[0]->container_type_classname($container[0]),
            new $container[0]->container_form_classname($container[0]),
            $banners,
            $container[0]
        );
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
        $randomBannerForm = $this->_getRandomBannerForm();

        return $containerForm->getRenderedView([
            'content' => $containerType->getRenderedView([
                'content' => (new $randomBannerForm($container, $banners))->getRenderedView()
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
            Carousel::class,
            Simple::class,
            ThreeInRow::class
        ];

        $randForm = (new RandomGenerator(0, count($bannerForms) - 1))->getRandomNumber();

        return $bannerForms[$randForm];
    }
}