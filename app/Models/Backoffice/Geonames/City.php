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
 * City model for Geonames data
 *
 * Class City
 * @package App\Models\Backoffice\Geonames
 */

class City extends Model
{
    protected $table = 'geo-city';

    protected $fillable = ['country_code', 'name', 'area_code'];

    protected $hidden = ['id'];

    public $timestamps = false;
}