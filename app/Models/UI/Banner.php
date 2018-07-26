<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = ['website_id', 'campaign_id', 'advgroup_id', 'adv_id', 'banner_id', 'path', 'container_id', 'title', 'description', 'date_from', 'date_to', 'adv_text', 'adv_url'];
    protected $hidden = ['id'];

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
