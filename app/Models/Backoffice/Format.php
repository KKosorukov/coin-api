<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

abstract class Format extends Model
{
    protected $connection = 'mysql-backoffice';

    public function __construct(array $attributes = [])
    {
        $this->config = $attributes;
        parent::__construct($attributes);
    }

    /**
     * Get className
     */
    public static function who() {
        return __CLASS__;
    }
}
