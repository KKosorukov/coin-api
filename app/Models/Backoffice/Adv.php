<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\AdvType;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $connection = 'mysql-backoffice';


    protected $fillable = [
        'name',
        'is_dummy',
        'adv_type_id',
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
        'text',
        'moderator_comment',
        'daily_budget'
    ];

    protected $hidden = [
        'id'
    ];

    /**
     * Has only one advType
     *
     * @return mixed
     */
    public function advType() {
        return $this->hasOne(AdvType::class, 'id', 'adv_type_id');
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

}
