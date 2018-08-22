<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\User;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'created_at',
        'updated_at',
        'status',
        'budget',
        'daily_budget',
        'current_daily_budget',
        'current_budget',
        'showcase_status'
    ];

    protected $guarded = [

    ];

    protected $hidden  = [
        'id'
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
    public function campaigns()
    {
        return $this->hasMany(AdvGroup::class, 'project_id', 'id');
    }

}
