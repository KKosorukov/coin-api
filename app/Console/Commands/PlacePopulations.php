<?php

namespace App\Console\Commands;

use App\Components\GeonamesConnector;
use Illuminate\Console\Command;

class PlacePopulations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geobase:populations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Place geobase populations';

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

        $geonamesConnector->placePopulations();

        return true;
    }
}
