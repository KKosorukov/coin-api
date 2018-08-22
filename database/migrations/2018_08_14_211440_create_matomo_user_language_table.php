<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoUserLanguageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_user_language', function(Blueprint $table)
		{
			$table->string('login', 100)->primary();
			$table->string('language', 10);
			$table->boolean('use_12_hour_clock')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_user_language');
	}

}
