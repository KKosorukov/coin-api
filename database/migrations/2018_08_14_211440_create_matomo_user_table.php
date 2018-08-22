<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_user', function(Blueprint $table)
		{
			$table->string('login', 100)->primary();
			$table->string('password');
			$table->string('alias', 45);
			$table->string('email', 100);
			$table->char('token_auth', 32)->unique('uniq_keytoken');
			$table->boolean('superuser_access')->default(0);
			$table->dateTime('date_registered')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_user');
	}

}
