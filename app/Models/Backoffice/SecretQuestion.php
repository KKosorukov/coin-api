<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

class SecretQuestion extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $fillable = ['question'];

    public $timestamps = false;

    /**
     * Has only one advType
     *
     * @return mixed
     */
    public function users() {
        return $this->hasMany(User::class, 'secret_question_id', 'id');
    }
}
