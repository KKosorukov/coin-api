<?php

namespace App\Models\Backoffice\BannerForms;

use App\Models\Backoffice\BannerForm;
use Illuminate\Database\Eloquent\Model;

/**
 * TwoInRow form for banners
 *
 * Class TwoInRow
 * @package App\Models\Backoffice\BannerForms
 */
class TwoInRow extends BannerForm
{
    protected $view = 'banner/forms/two-in-row';

}