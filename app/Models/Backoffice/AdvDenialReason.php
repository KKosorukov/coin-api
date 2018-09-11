<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class AdvDenialReason extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'adv_id',
        'denial_reason_id',
        'denial_date'
    ];

    protected $table = 'advs-denial_reasons';

    public $timestamps = false;
}
