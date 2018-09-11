<?php
/**
 * Created by IntelliJ IDEA.
 * User: celsshbobcat
 * Date: 30.07.18
 * Time: 13:47
 */

namespace App\Components;

use GuzzleHttp\Client as GuzzleClient;

use App\Models\Backoffice\Geonames\City;
use App\Models\Backoffice\Geonames\Country;
use App\Models\Backoffice\Geonames\Area;
use App\Models\Backoffice\Geonames\Continent;
use GeoIp2\Database\Reader;

use League\Csv\Reader as CsvReader;
use League\Csv\Statement;

use Storage;
use DB;

class GeonamesConnector extends Component {

    private $geonamesApiUrl;
    private $login = null;
    private $guzzle = null;

    public function __construct($login = null)
    {
        $this->login = $login ?? env('GEONAMES_LOGIN');
        $this->geonamesApiUrl = env('GEONAMES_API_URL');
        $this->guzzle = new GuzzleClient();

        parent::__construct();
    }

    /**
     * Get continents from geonames or DB, if exists
     */
    public function getContinents() {
        // If not exists countries in databse...
        if(count(Continent::all()) == 0) {
            $this->placeContinentsIntoDatabase();
        }

        return Continent::all();
    }

    /**
     * Get countries from geonames or DB, if exists
     */
    public function getCountries($continent) {
        // If not exists countries in database...
        if(count(Country::all()) == 0) {
            $this->placeCountriesIntoDatabase();
        }

        return Country::whereIn('continent_code', $continent)->get();
    }

    /**
     * Get areas from geonames or DB, if exists
     */
    public function getAreas($country) {
        // If not exists countries in databse...
        if(count(Area::all()) == 0) {
            $this->placeAreasIntoDatabase();
        }

        return Area::whereIn('country_code', $country)->get();
    }

    /**
     * Get cities from geonames or DB, if exists
     */
    public function getCities($country, $area) {
        // If not exists countries in databse...
        if(count(Area::all()) == 0) {
            $this->placeCitiesIntoDatabase();
        }

        return City::whereIn('country_code', $country)->whereIn('area_code', $area)->get();
    }


    private function _getCountriesFromGeonames() {
        $res = $this->guzzle->request('GET', $this->geonamesApiUrl.'/countryInfo?lang=en&username='.$this->login);
        if($res->getStatusCode() == 200) {
            $xml = simplexml_load_string($res->getBody());
            $json = json_encode($xml);
            $jsonDecoded = json_decode($json,TRUE);
            return isset($jsonDecoded['country']) ? $jsonDecoded['country'] : [];
        }

        return $res->getStatusCode();
    }


    /**
     * Place continents into database, if not exist
     */
    public function placeContinentsIntoDatabase() {
        DB::connection('mysql-backoffice')->table((new Continent)->getTable())->truncate();

        $countries = $this->_getCountriesFromGeonames();

        $continents = [];
        foreach ($countries as $country) {
            if(!isset($continents[$country['continent']])) {
                $continents[$country['continent']] = $country['continentName'];
            }
        }

        foreach($continents as $index => $continent) {
            $newContinent = new Continent();
            $newContinent->name = $continent;
            $newContinent->continent_code = $index;
            $newContinent->save();
        }
    }


    /**
     * Place all countries into database, if not exist
     */
    public function placeCountriesIntoDatabase() {
        DB::connection('mysql-backoffice')->table((new Country)->getTable())->truncate();

        $countries = $this->_getCountriesFromGeonames();

        foreach($countries as $country) {
            $countryModel = new Country();
            $countryModel->country_code = $country['countryCode'];
            $countryModel->name = $country['countryName'];
            $countryModel->continent_code = $country['continent'];
            $countryModel->save();
        }
    }

    /**
     * @TODO
     * Place all areas into databse, if not exists
     */
    public function placeAreasIntoDatabase() {
        DB::connection('mysql-backoffice')->table((new Area)->getTable())->truncate();

        $csv = CsvReader::createFromPath(Storage::path(env('CITIES_CSV_FILE')))->setHeaderOffset(0);

        foreach ($csv as $record) {
            if(!$record['subdivision_1_name']) {
                continue;
            }

            $existsArea = Area::where(['area_code' => $record['subdivision_1_iso_code']])->first();
            if($existsArea) {
                continue;
            }

            $cityModel = new Area;
            $cityModel->country_code = $record['country_iso_code'];
            $cityModel->area_code = $record['subdivision_1_iso_code'];
            $cityModel->name = $record['subdivision_1_name'];
            $cityModel->save();
        }
    }

    /**
     * @TODO
     * Place all cities into databse, if not exists
     */
    public function placeCitiesIntoDatabase() {
        DB::connection('mysql-backoffice')->table((new City)->getTable())->truncate();

        $csv = CsvReader::createFromPath(Storage::path(env('CITIES_CSV_FILE')))->setHeaderOffset(0);

        foreach ($csv as $record) {
            if(!$record['city_name']) {
                continue;
            }

            $cityModel = new City;
            $cityModel->country_code = $record['country_iso_code'];
            $cityModel->area_code = $record['subdivision_1_iso_code'];
            $cityModel->name = $record['city_name'];
            $cityModel->save();
        }
    }

    /**
     * Place all populations into database
     */
    public function placePopulations() {
        $csv = CsvReader::createFromPath(Storage::path(env('POPULATIONS_COUNTRIES_CSV_FILE')))->setHeaderOffset(0);

        foreach ($csv as $record) {
            $country = Country::where('country_code', $record['Code'])->first();
            $country->population = str_replace(',', '', $record['Population']);
            $country->save();
        }

        echo "Success! Populations for countries added into database.\r\n";


        $csv = CsvReader::createFromPath(Storage::path(env('POPULATIONS_CONTINENTS_CSV_FILE')))->setHeaderOffset(0);

        foreach ($csv as $record) {
            $country = Continent::where('continent_code', $record['Code'])->first();
            $country->population = str_replace(',', '', $record['Population']);
            $country->save();
        }

        echo "Success! Populations for continents added into database.\r\n";
    }
}