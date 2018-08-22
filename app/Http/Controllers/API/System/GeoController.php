<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillk
 * Date: 8/15/18
 * Time: 4:53 PM
 */

namespace App\Http\Controllers\API\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Backoffice\Geonames\Area;
use App\Models\Backoffice\Geonames\City;
use App\Models\Backoffice\Geonames\Continent;
use App\Models\Backoffice\Geonames\Country;

use Illuminate\Support\Facades\Storage;

class GeoController extends Controller
{
    private $geofileName = 'geo/geo.json';

    public function __construct()
    {

    }

    /**
     * Get JSON info about regions and countries
     *
     * {
     *   regions:[
     *       {
     *          code:"EU", name="Europe", aud_percent=0.4, aud_absolute:500000000
     *       },
     *           ...
     *   ],
     *   countries:[
     *          {
     *              code:"US", name:"United States", region_code:"AM", aud_percent:0.1, aud_absolute:300000000,
     *          }
     *          ...
     *      ]
        }
     */
    public function getJsonInfo() {
        if(!Storage::disk('public')->exists($this->geofileName)) {

            $regions = Area::all();
            $countries = Country::all();

            $answer = [
                'regions' => [],
                'countries' => []
            ];

            foreach ($regions as $region) {
                $answer['regions'][] = [
                    'code' => $region->area_code,
                    'name' => $region->name,
                    'aud_percent' => 0,
                    'aud_absolute' => 0
                ];
            }

            foreach ($countries as $country) {
                $answer['countries'][] = [
                    'code' => $country->country_code,
                    'name' => $country->name,
                    'region_code' => $country->continent_code,
                    'aud_percent' => 0,
                    'aud_absolute' => 0
                ];
            }

            Storage::disk('public')->put($this->geofileName, json_encode($answer, JSON_UNESCAPED_UNICODE));
        }

        return Storage::disk('public')->get($this->geofileName);
    }

}