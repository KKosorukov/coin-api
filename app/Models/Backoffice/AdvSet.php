<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class AdvSet extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $table = 'advs-banner_forms-banner_types';

    public $timestamps = false;

    protected $fillable = [
        'adv_id',
        'banner_form_id',
        'banner_type_id',
        'container_form_id',
        'container_type_id',
        'alias'
    ];

    protected $hidden = [
        'id'
    ];
}
