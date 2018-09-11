<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class SiteInterest extends Model
{
    protected $connection = 'mysql-backoffice';
    protected $table      = 'sites-interests';

    protected $fillable = [
        'site_id',
        'interest_id'
    ];

    public $timestamps = false;
}
