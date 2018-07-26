<?php

namespace App\Models\Backoffice;

use App\Models\Backoffice\Adv;

use Illuminate\Database\Eloquent\Model;

class AdvType extends Model
{

    protected $connection = 'mysql-backoffice';


    protected $fillable = ['title', 'description', 'code', 'is_default_type'];

    /**
     * Has many Adv
     *
     * @return mixed
     */
    public function adv() {
        return $this->hasMany(Adv::class, 'adv_type_id', 'id');
    }
}
