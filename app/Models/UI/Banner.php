<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = [
        'project_id',
        'website_id',
        'campaign_id',
        'advgroup_id',
        'adv_id',
        'banner_id',
        'path',
        'container_id',
        'title',
        'description',
        'date_from',
        'date_to',
        'adv_text',
        'adv_url',
        'continent_code',
        'country_code',
        'area_code',
        'city',
        'time_end',
        'time_begin',
        'browser_language',
        'additional_adv_url_1',
        'additional_adv_url_2',
        'additional_adv_url_3',
        'additional_adv_url_4',
        'additional_adv_url_desc_1',
        'additional_adv_url_desc_2',
        'additional_adv_url_desc_3',
        'additional_adv_url_desc_4',
        'probability',
        'banner_form_id',
        'banner_type_id',
        'container_form_id',
        'container_type_id'
    ];
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
