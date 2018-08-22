<?php

namespace App\Console\Commands;

use App\Components\Budgetor;
use Illuminate\Console\Command;

class UpdateShowcaseStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update showcase elements statuses on new day';

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
        return (new Budgetor())->updateStatusOnNewDay();
    }
}
