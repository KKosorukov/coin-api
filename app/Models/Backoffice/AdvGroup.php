<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backoffice\User;

class AdvGroup extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'name',
        'user_id',
        'campaign_id',
        'status',
        'budget',
        'daily_budget',
        'current_daily_budget',
        'current_budget',
        'click_price',
        'showcase_status'
    ];

    protected $guarded = [
        'created_at'
    ];

    protected $hidden = [
        'id'
    ];

    /**
     * Has only one user
     *
     * @return mixed
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get owner of this campaign
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function campaign() {
        return $this->hasOne(Campaign::class,'id', 'campaign_id');
    }

    /**
     * Has many advs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advs() {
        return $this->hasMany(Adv::class, 'adv_group_id', 'id');
    }

    /**
     * Has many adv groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function segments() {
        return $this->belongsToMany('App\Models\Backoffice\Segment', 'segments-adv_groups', 'adv_group_id', 'segment_id');
    }

    public function getScope() {
        return null;
    }

    public function getCtr() {
        return $this->num_shows > 0 ? $this->num_clicks / $this->num_shows : 0;
    }

    public function getCpc() {
        return $this->num_clicks > 0 ? $this->expenses / $this->num_clicks : 0;
    }

}
