<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name', 'displays'];

    protected $guarded = ['id'];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}