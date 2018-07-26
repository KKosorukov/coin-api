<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

use App\Components\CurrenciesConverter;

class Bill extends Model
{

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['user_id', 'num_tokens'];

    /**
     * Has only one user
     *
     * @return mixed
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get bill attribute in different currencies
     */
    public function getNumTokensAttribute($value) {
        return (new CurrenciesConverter())->convertAdt($value);
    }
}
