<?php

namespace App\Models\Backoffice\Matomo;

use App\Models\Backoffice\User as BackofficeUser;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $table = 'matomo_user';

    protected $guarded = [
        'login', 'alias', 'email', 'token_auth', 'superuser_access', 'date_registered'
    ];

    protected $hidden = [
        'password'
    ];


    /**
     * Has one matomo row
     * @return Relations\HasOne
     */
    public function matomo()
    {
        return $this->hasOne(BackofficeUser::class, 'email', 'email');
    }

}
