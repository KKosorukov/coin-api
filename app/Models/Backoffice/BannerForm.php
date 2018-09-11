<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DummyBanner;
use App\Components\RandomGenerator;

use App\Models\Backoffice\BannerTypes\Image;
use App\Models\Backoffice\BannerTypes\ImageText;
use App\Models\Backoffice\BannerTypes\Text;

use Illuminate\Support\Facades\Crypt;

/**
 * Base model of BannerForm
 *
 * Class BannerForm
 * @package App\Models\Backoffice
 */


class BannerForm extends Model
{
    use DummyBanner;

    public $timestamps = false;

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['name', 'classname'];

    protected $hidden = ['id'];

    protected $view = 'insert-your-view-here';

    protected $container = null;

    protected $viewParams = [];

    protected $dummyText = '[DUMMY]';

    protected $banners = [];

    public function __construct($container = null, $banners = [], array $attributes = [])
    {
        if($container) {
            $this->container = $container;

            $this->viewParams += [
                'dummy' => $this->getDummyHtml($container->width, $container->height, $this->dummyText),
                'container' => $container,
                'num_banners' => $container->num_banners
            ];
        }

        $this->banners = $banners;


        parent::__construct($attributes);
    }

    /**
     * Has many containers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containers() {
        return $this->hasMany('App\Models\Backoffice\Container', 'banner_form_id', 'id');
    }

    /**
     * Return a view of form
     *
     * @return mixed
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Get rendered view
     *
     * @param $additionalParams
     * @return string
     * @throws \Throwable
     */
    public function getRenderedView($additionalParams = []) {

        $randomBannerType = $this->_getRandomBannerType();

        $num = count($this->banners);
        $renderedBanners = '';
        $renderedBannersNotGlued = [];

        for($i = 0; $i < $num; $i++) {
            $rendered = (new $randomBannerType($this->container, $this->banners[$i]))->recalcBudgets()->getRenderedView([
                'bannerId' => $this->_getCryptedBannerId($this->banners[$i])
            ]);

            $renderedBanners .= $rendered;
            $renderedBannersNotGlued[] = $rendered;
        }

        $this->viewParams += [
            'content' => $renderedBanners,
            'banners' => $renderedBannersNotGlued
        ];

        return view($this->view, $this->viewParams + $additionalParams)->render();
    }


    /**
     * Get random banner form
     *
     * @return mixed
     */
    private function _getRandomBannerType() {
        $bannerTypes = [
            Image::class,
            ImageText::class,
            Text::class
        ];

        $randType = (new RandomGenerator(0, count($bannerTypes) - 1))->getRandomNumber();

        return $bannerTypes[$randType];
    }

    /**
     * Get crypted banner id
     */
    private function _getCryptedBannerId($banner) {
        return Crypt::encryptString($banner->campaign_id.'|'.$banner->advgroup_id.'|'.$banner->adv_id.'|'.$banner->banner_id.'|'.$banner->project_id.'|'.$banner->id);
    }
}
