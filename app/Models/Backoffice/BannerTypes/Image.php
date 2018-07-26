<?php

namespace App\Models\Backoffice\BannerTypes;

use App\Models\Backoffice\BannerType;
use Illuminate\Database\Eloquent\Model;

/**
 * Only image type for banners
 *
 * Class Image
 * @package App\Models\Backoffice\BannerTypes
 */
class Image extends BannerType
{
    protected $view = 'banner/types/only-image';
}