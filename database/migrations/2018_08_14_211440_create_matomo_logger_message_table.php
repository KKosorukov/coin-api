<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLoggerMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_logger_message', function(Blueprint $table)
		{
			$table->increments('idlogger_message');
			$table->string('tag', 50)->nullable();
			$table->dateTime('timestamp')->nullable();
			$table->string('level', 16)->nullable();
			$table->text('message', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_logger_message');
	}

}
