<?php

namespace App\Models\Backoffice\ContainerForms;

use App\Models\Backoffice\ContainerForm;
use Illuminate\Database\Eloquent\Model;

/**
 * Inline ContainerForm for banners
 *
 * Class Inline
 * @package App\Models\Backoffice\ContainerForms
 */
class Inline extends ContainerForm
{
    protected $view = 'container/forms/inline';

}