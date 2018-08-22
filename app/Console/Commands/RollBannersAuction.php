<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Components\Auctioner;

class RollBannersAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:roll {clear}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command rolls an mechanism about auction';

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
       return (new Auctioner('v1'))->run($this->argument('clear'));
    }
}
