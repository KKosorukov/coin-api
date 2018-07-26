<?php

namespace App\Models\Backoffice\BannerForms;

use App\Models\Backoffice\BannerForm;
use Illuminate\Database\Eloquent\Model;

/**
 * Simple form for banners
 *
 * Class Simple
 * @package App\Models\Backoffice\BannerForms
 */
class Simple extends BannerForm
{
    protected $view = 'banner/forms/simple-picture';
}