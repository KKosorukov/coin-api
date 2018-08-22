<?php

namespace App\Models\Backoffice;

class Manager extends User
{
    /**
     * @var Adv[]
     */
    public $advs;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advs()
    {
        return $this->hasMany(Adv::class, 'user_id', 'id');
    }
}