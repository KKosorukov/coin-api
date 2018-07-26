<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\AdvGroup;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['id', 'name', 'user_id', 'date_from', 'date_to', 'comment', 'status_moderation', 'status_global', 'daily_budget'];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advs() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

}
