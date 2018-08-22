<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_report', function(Blueprint $table)
		{
			$table->integer('idreport', true);
			$table->integer('idsite');
			$table->string('login', 100);
			$table->string('description');
			$table->integer('idsegment')->nullable();
			$table->string('period', 10);
			$table->boolean('hour')->default(0);
			$table->string('type', 10);
			$table->string('format', 10);
			$table->text('reports', 65535);
			$table->text('parameters', 65535)->nullable();
			$table->dateTime('ts_created')->nullable();
			$table->dateTime('ts_last_sent')->nullable();
			$table->boolean('deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_report');
	}

}
