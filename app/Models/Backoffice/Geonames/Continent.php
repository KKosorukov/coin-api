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
 * Continent model for Geonames data
 *
 * Class Continent
 * @package App\Models\Backoffice\Geonames
 */

class Continent extends Model
{
    protected $table = 'geo-continent';

    protected $fillable = ['name', 'continent_code', 'population'];

    protected $hidden = ['id'];

    public $timestamps = false;
}