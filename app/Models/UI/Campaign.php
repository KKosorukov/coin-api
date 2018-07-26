<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = ['real_id', 'daily_budget', 'date_from', 'date_to'];
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
