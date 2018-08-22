<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoSessionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_session', function(Blueprint $table)
		{
			$table->string('id')->primary();
			$table->integer('modified')->nullable();
			$table->integer('lifetime')->nullable();
			$table->text('data', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_session');
	}

}
