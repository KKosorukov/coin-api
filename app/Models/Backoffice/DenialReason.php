<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class DenialReason extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'text'
    ];

    public $timestamps = false;
}
