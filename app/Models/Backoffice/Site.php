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
    const STATUS_BLOCKED    = 6;

    protected $hidden   = ['id'];
    protected $fillable = ['title', 'is_text', 'is_banner', 'is_video', 'status', 'user_id', 'host', 'url', 'balance'];

    /**
     * @var int
     */
    public $user_id;

    /**
     * @todo для этого метода явно есть место получше. Плюс, возможно, Ларавель уже умеет так делать из коробки.
     * @param string $url
     * @return string
     */
    public function normalizeUrl(string $url): string
    {
        $parsedUrl = parse_url($url);

        if ($parsedUrl) {
            return array_key_exists('scheme', $parsedUrl) ? $url : "http://{$url}";
        }

        return $url;
    }

    /**
     * Has only one owner (webmaster)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Has one matomo row
     *
     * @return Relations\HasOne
     */
    public function backofficeSite()
    {
        return $this->hasOne(\App\Models\Backoffice\Matomo\Site::class, 'idsite', 'id');
    }
}