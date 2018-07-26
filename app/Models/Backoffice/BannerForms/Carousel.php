<?php

namespace App\Models\Backoffice\BannerForms;

use App\Models\Backoffice\BannerForm;
use Illuminate\Database\Eloquent\Model;

/**
 * Carousel form for banners
 *
 * Class Carousel
 * @package App\Models\Backoffice\BannerForms
 */
class Carousel extends BannerForm
{
    protected $view = 'banner/forms/carousel';

}