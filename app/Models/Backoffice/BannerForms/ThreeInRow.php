<?php

namespace App\Models\Backoffice\BannerForms;

use App\Models\Backoffice\BannerForm;
use Illuminate\Database\Eloquent\Model;

/**
 * ThreeInRow form for banners
 *
 * Class ThreeInRow
 * @package App\Models\Backoffice\BannerForms
 */
class ThreeInRow extends BannerForm
{
    protected $view = 'banner/forms/three-in-row';

}