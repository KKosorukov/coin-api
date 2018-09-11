<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class AdvInterest extends Model
{
    protected $connection = 'mysql-backoffice';
    protected $table      = 'advs-interests';

    protected $fillable = [
        'adv_id',
        'interest_id'
    ];

    public $timestamps = false;
}
