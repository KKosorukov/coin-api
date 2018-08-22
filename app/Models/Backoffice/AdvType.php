<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\Adv;

use Illuminate\Database\Eloquent\Model;

class AdvType extends Model
{

    protected $connection = 'mysql-backoffice';


    protected $fillable = ['title', 'description', 'code', 'is_default_type'];

    /**
     * Has many advs
     *
     * @return mixed
     */
    public function advType() {
        return $this->belongsToMany('App\Models\Backoffice\Adv', 'advs_types-advs', 'adv_type_id', 'adv_id');
    }
}
