<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Components\Auctioner;

class DropOldBanners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:drop-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop old banners when campaigns are over';

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
        return (new Auctioner())->dropOld();
    }
}
