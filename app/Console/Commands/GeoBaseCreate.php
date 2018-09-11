<?php

namespace App\Console\Commands;

use App\Components\GeonamesConnector;
use Illuminate\Console\Command;

class GeoBaseCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geobase:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create base geobase';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $geonamesConnector = new GeonamesConnector();

        $geonamesConnector->placeContinentsIntoDatabase();
        $geonamesConnector->placeCountriesIntoDatabase();
        $geonamesConnector->placeCitiesIntoDatabase();
        $geonamesConnector->placeAreasIntoDatabase();
        $geonamesConnector->placePopulations();

        return true;
    }
}
