<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallMatomo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'matomo:init {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize matomo config, run default database.';

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
        if (!$this->option('force')) {
            if (!$this->confirm('Do you wish to initialize EMPTY matomo tables? Current matomo tables will be dropped.')) {
                $this->warn('Stopped by user');
                return false;
            }
        }

        $BACKOFFICE_DB_HOST     = env('BACKOFFICE_DB_HOST');
        $BACKOFFICE_DB_USERNAME = env('BACKOFFICE_DB_USERNAME');
        $BACKOFFICE_DB_PASSWORD = env('BACKOFFICE_DB_PASSWORD');
        $BACKOFFICE_DB_DATABASE = env('BACKOFFICE_DB_DATABASE');
        $config = <<<CONFIG
php matomo/console config:set --quiet --section="database" --key="host" --value="$BACKOFFICE_DB_HOST"
php matomo/console config:set --quiet --section="database" --key="username" --value="$BACKOFFICE_DB_USERNAME"
php matomo/console config:set --quiet --section="database" --key="password" --value="$BACKOFFICE_DB_PASSWORD"
php matomo/console config:set --quiet --section="database" --key="dbname" --value="$BACKOFFICE_DB_DATABASE"
php matomo/console config:set --quiet --section="database" --key="tables_prefix" --value="matomo_"
CONFIG;
        echo exec($config);
        $query = file_get_contents(database_path('matomo_init.sql'));
        DB::unprepared(
            sprintf(
                $query,
                env('MATOMO_BASE_URL','http://piwik.mac.digital-lab.ru/'),
                env('MATOMO_BASE_URL', 'http://piwik.mac.digital-lab.ru/'),
                env('MATOMO_ADMIN_EMAIL', 'admin@testmail.com')
            )
        );
    }
}
