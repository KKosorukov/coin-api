<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    const STATUS_ACTIVE     = 1;
    const STATUS_MODERATION = 2;
    const STATUS_REJECTED   = 3;
    const STATUS_STOPPED    = 4;
    const STATUS_ARCHIVED   = 5;

    protected $hidden   = ['id'];
    protected $fillable = ['title', 'is_text', 'is_banner', 'is_video', 'status', 'user_id', 'host', 'url', 'balance'];

    /**
     * Has only one owner (webmaster)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}