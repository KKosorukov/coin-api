<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\AdvType;
use App\Models\Backoffice\User;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $connection = 'mysql-backoffice';


    protected $fillable = [
        'name',
        'is_dummy',
        'user_id',
        'campaign_id',
        'adv_group_id',
        'comment',
        'picture',
        'status_global',
        'status_moderation',
        'num_shows',
        'num_clicks',
        'url',
        'title',
        'short_description',
        'long_description',
        'moderator_comment',
        'budget',
        'daily_budget',
        'additional_adv_url_1',
        'additional_adv_url_2',
        'additional_adv_url_3',
        'additional_adv_url_4',
        'additional_adv_url_desc_1',
        'additional_adv_url_desc_2',
        'additional_adv_url_desc_3',
        'additional_adv_url_desc_4',
        'current_budget',
        'current_daily_budget',
        'showcase_status'
    ];

    protected $guarded = [

    ];

    protected $hidden = [
        'id'
    ];

    public function banners() {
        return $this->hasMany(Banner::class, 'adv_id', 'id');
    }

    /**
     * Has many advTypes
     *
     * @return mixed
     */
    public function advType() {
        return $this->belongsToMany('App\Models\Backoffice\AdvType', 'advs_types-advs', 'adv_id', 'adv_type_id');
    }

    /**
     * Has only one user
     *
     * @return mixed
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Has only one adv group
     */
    public function advGroup() {
        return $this->hasOne(AdvGroup::class, 'id', 'adv_group_id');
    }

    /**
     * Get owner of this campaign
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function campaign() {
        return $this->hasOne(Campaign::class,'id', 'campaign_id');
    }

    /**
     * Get banners of this
     * @return mixed
     */
    public function getBanners() {
        $banners = Banner::where([
            'adv_id' => $this->id,
        ])->get();

        return $banners;
    }


    /**
     * Has many bannerForms
     */
    public function bannerForms() {

    }

    /**
     * Has many bannerTypes
     */
    public function bannerTypes() {

    }

    /**
     * Has many containerForms
     */
    public function containerForms() {

    }

    /**
     * Has many containerTypes
     */
    public function containerTypes() {

    }

    /**
     * Has many sets
     */
    public function sets() {
        return $this->hasMany(AdvSet::class, 'adv_id', 'id');
    }

}
