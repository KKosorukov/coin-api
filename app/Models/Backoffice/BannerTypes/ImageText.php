<?php

namespace App\Models\Backoffice\BannerTypes;

use App\Models\Backoffice\BannerType;
use Illuminate\Database\Eloquent\Model;

/**
 * Image and text type for banners
 *
 * Class ImageText
 * @package App\Models\Backoffice\BannerTypes
 */
class ImageText extends BannerType
{
    protected $view = 'banner/types/image-text';

}