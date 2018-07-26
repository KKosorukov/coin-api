<?php

namespace App\Models\Backoffice\ContainerTypes;

use App\Models\Backoffice\ContainerType;
use Illuminate\Database\Eloquent\Model;

/**
 * Vertical ContainerType for banners
 *
 * Class Vertical
 * @package App\Models\Backoffice\ContainerTypes
 */
class Vertical extends ContainerType
{
    protected $view = 'container/types/vertical';
}