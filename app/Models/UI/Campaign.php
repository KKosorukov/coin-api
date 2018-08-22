<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = [
        'real_id',
        'date_from',
        'date_to',
        'daily_budget',
        'budget',
        'current_daily_budget',
        'current_budget',
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
