<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoUserDashboardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_user_dashboard', function(Blueprint $table)
		{
			$table->string('login', 100);
			$table->integer('iddashboard');
			$table->string('name', 100)->nullable();
			$table->text('layout', 65535);
			$table->primary(['login', 'iddashboard']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_user_dashboard');
	}

}
