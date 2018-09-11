<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class SiteDenialReason extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'site_id',
        'denial_reason_id',
        'denial_date'
    ];

    protected $table = 'sites-denial_reasons';

    public $timestamps = false;
}
