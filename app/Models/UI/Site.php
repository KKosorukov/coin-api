<?php

namespace App\Models\UI;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $connection = 'mysql-ui';

    protected $fillable = [
        'user_id',
        'url',
        'host',
        'is_text',
        'is_banner',
        'is_video',
        'balance',
        'status',
        'host',
        'num_shows'
    ];

    protected $hidden = ['id'];

    public $timestamps = false;

    protected $table = 'sites';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Get className
     */
    public static function who() {
        return __CLASS__;
    }

}
