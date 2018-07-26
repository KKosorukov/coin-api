<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Components\Auctioner;

class SuckToBackoffice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:suck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suck data from ui-database into backoffice-databse';

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
        return (new Auctioner())->suckIntoBackoffice();
    }
}
