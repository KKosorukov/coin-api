<?php

namespace App\Models\Backoffice;

class Webmaster extends User
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites() {
        return $this->hasMany(Site::class, 'user_id', 'id');
    }
}