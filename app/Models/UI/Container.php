<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = [
        'user_id',
        'width',
        'height',
        'container_type_id',
        'container_form_id',
        'num_banners',
        'container_type_name',
        'container_form_name',
        'container_type_classname',
        'container_form_classname'
    ];

    protected $hidden = ['id'];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Get className
     */
    public static function who() {
        return __CLASS__;
    }

}
