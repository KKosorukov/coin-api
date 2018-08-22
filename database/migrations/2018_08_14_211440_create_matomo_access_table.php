<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_access', function(Blueprint $table)
		{
			$table->string('login', 100);
			$table->integer('idsite')->unsigned();
			$table->string('access', 10)->nullable();
			$table->primary(['login','idsite']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_access');
	}

}
