<?php
/**
 * Created by IntelliJ IDEA.
 * User: celsshbobcat
 * Date: 30.07.18
 * Time: 14:50
 */

namespace App\Models\Backoffice\Geonames;

use Illuminate\Database\Eloquent\Model;

/**
 * Contry model for Geonames data
 *
 * Class Country
 * @package App\Models\Backoffice\Geonames
 */

class Country extends Model
{
    protected $table = 'geo-country';

    protected $fillable = ['country_code', 'name', 'continent'];

    protected $hidden = ['id'];

    public $timestamps = false;
}