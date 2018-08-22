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
 * Area model for Geonames data
 *
 * Class Area
 * @package App\Models\Backoffice\Geonames
 */

class Area extends Model
{
    protected $table = 'geo-area';

    protected $fillable = ['country_code', 'name', 'area_code'];

    protected $hidden = ['id'];

    public $timestamps = false;
}