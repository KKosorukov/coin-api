<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = [
        'real_id',
        'banner_type_id',
        'banner_form_id',
        'budget',
        'daily_budget',
        'current_budget',
        'current_daily_budget',
        'status',
        'showcase_status'
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
