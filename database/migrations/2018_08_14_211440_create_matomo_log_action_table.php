<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_log_action', function(Blueprint $table)
		{
			$table->increments('idaction');
			$table->text('name', 65535)->nullable();
			$table->integer('hash')->unsigned();
			$table->boolean('type')->nullable();
			$table->boolean('url_prefix')->nullable();
			$table->index(['type','hash'], 'index_type_hash');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_log_action');
	}

}
