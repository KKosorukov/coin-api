<?php

namespace App\Models\Backoffice\Matomo;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backoffice\Site as BackofficeSite;

class Site extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $table = 'matomo_site';

    protected $guarded = [
        'idsite', 'name', 'main_url'
    ];

    /**
     * Has one backoffice row
     * @return Relations\HasOne
     */
    public function backofficeSite()
    {
        return $this->hasOne(BackofficeSite::class, 'id', 'idsite');
    }

}
