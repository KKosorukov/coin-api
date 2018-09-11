<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = [
        'title'
    ];

    public $timestamps = false;
}
