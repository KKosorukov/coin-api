<?php

namespace App\Models\Backoffice\AdvTypes;

use App\Components\RandomGenerator;
use App\Http\Resources\AdvResource;
use App\Interfaces\IBannerable;
use App\Traits\DummyBanner;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backoffice\Banner;
use Storage;

/**
 * Simple type of ad
 *
 * Class AdvBanner
 * @package App\Models\Backoffice\AdvTypes
 */
class AdvBanner extends Banner implements IBannerable
{
    use DummyBanner;

    protected $table = 'banners';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Get simple type with template
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get() {

        parent::get();

        if(isset($this->config['num-in-row'])) { // Threee in row
            return $this->_getThreeInRow();
        }

        $this->_setAutoWidthAndHeight();
        $this->_setBannerFileName();

        return $this->_getSimple();
    }

    /**
     * Set banner filename
     */
    private function _setBannerFileName() {
        if(isset($this->config['width'], $this->config['height']) && (!isset($this->config['dontCreatePath']) || !$this->config['dontCreatePath'])) {
            $this->setBannerFileName($this->config['width'].'x'.$this->config['height']);
        } else {
            $this->bannerFileName = (new RandomGenerator())->getRandomNumber();
        }
    }

    /**
     * Set width and height of the banner
     */
    private function _setAutoWidthAndHeight() {
        if(!isset($this->config['width'], $this->config['height'])) {
            $this->config['width'] = 'auto';
            $this->config['height'] = 'auto';
        }
    }

    /**
     * Get three-in-row banner plate
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function _getThreeInRow($dummyHtml = '') {
        return view('banner/three-in-row', [
            'dummy' => $dummyHtml
        ]);
    }

    /**
     * Get simple banner, without any behavior
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    private function _getSimple() {
        if(Storage::disk('local')->exists('public/banners/dummy/'.$this->bannerFileName.'.png')) {
            return view('banner/simple-picture', [
                'url' => '/banners/dummy/'.$this->bannerFileName.'.png',
                'additionalCssClass' => 'banner'.$this->bannerFileName,
                'width' => $this->config['width'],
                'height' => $this->config['height'],
                'dummy' => ''
            ]);
        } else {
            return 'Incorrect banner link';
        }
    }

    /**
     * Get dummy ad
     *
     * @return mixed|void
     */
    public function dummy() {
        $this->_setAutoWidthAndHeight();
        $this->_setBannerFileName();

        if(isset($this->config['num-in-row'])) { // Threee in row
            return $this->_getThreeInRow($this->getDummyHtml(170, 100));
        }

        if(Storage::disk('local')->exists('public/banners/dummy/'.$this->bannerFileName.'.png')) {
            return view('banner/simple-picture', [
                'url' => '/banners/dummy/'.$this->bannerFileName.'.png',
                'additionalCssClass' => 'banner'.$this->bannerFileName,
                'width' => $this->config['width'],
                'height' => $this->config['height'],
                'dummy' => $this->getDummyHtml($this->config['width'], $this->config['height'])
            ]);
        } else {
            return 'Incorrect banner link';
        }
    }
}