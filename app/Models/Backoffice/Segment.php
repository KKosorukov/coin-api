<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = ['name', 'comment', 'type', 'params', 'is_private'];

    protected $hidden = ['id'];

    public $timestamps = false;

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

    /**
     * Has many adv groups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function advGroups() {
        return $this->belongsToMany('App\Models\Backoffice\AdvGroup', 'segments-adv_groups', 'segment_id', 'adv_group_id');
    }

}
