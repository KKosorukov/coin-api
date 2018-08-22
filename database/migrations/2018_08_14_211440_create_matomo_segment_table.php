<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoSegmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_segment', function(Blueprint $table)
		{
			$table->integer('idsegment', true);
			$table->string('name');
			$table->text('definition', 65535);
			$table->string('login', 100);
			$table->boolean('enable_all_users')->default(0);
			$table->integer('enable_only_idsite')->nullable();
			$table->boolean('auto_archive')->default(0);
			$table->dateTime('ts_created')->nullable();
			$table->dateTime('ts_last_edit')->nullable();
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
		Schema::drop('matomo_segment');
	}

}
