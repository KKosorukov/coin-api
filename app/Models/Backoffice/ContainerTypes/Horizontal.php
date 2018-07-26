<?php

namespace App\Models\Backoffice\ContainerTypes;

use App\Models\Backoffice\ContainerType;
use Illuminate\Database\Eloquent\Model;

/**
 * Horizontal ContainerType for banners
 *
 * Class Horizontal
 * @package App\Models\Backoffice\ContainerTypes
 */
class Horizontal extends ContainerType
{
    protected $view = 'container/types/horizontal';

}