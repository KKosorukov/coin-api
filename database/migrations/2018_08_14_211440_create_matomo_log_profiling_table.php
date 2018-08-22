<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogProfilingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE TABLE matomo_log_profiling (
        query TEXT NOT NULL,
                                  count INTEGER UNSIGNED NULL,
                                  sum_time_ms FLOAT NULL,
                                    UNIQUE KEY query(query(100))
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_log_profiling');
	}

}
