<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\User;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $hidden = [
        'id'
    ];

    protected $fillable = [
        'name',
        'user_id',
        'date_from',
        'date_to',
        'comment',
        'status_moderation',
        'status_global',
        'daily_budget',
        'budget',
        'project_id',
        'current_daily_budget',
        'current_budget',
        'showcase_status'
    ];

    protected $guarded = [

    ];


    /**
     * Has only one owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Has many advGroups
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advGroups()
    {
        return $this->hasMany(AdvGroup::class, 'campaign_id', 'id');
    }

    /**
     * Has one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

}
