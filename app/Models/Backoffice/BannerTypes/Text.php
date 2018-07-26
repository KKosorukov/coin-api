<?php

namespace App\Models\Backoffice\BannerTypes;

use App\Models\Backoffice\BannerType;
use Illuminate\Database\Eloquent\Model;

/**
 * Only text type for banners
 *
 * Class Text
 * @package App\Models\Backoffice\BannerTypes
 */
class Text extends BannerType
{
    protected $view = 'banner/types/only-text';

}