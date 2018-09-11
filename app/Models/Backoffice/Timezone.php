<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'description', 'offset'];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}