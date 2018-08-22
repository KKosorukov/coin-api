<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoGoalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_goal', function(Blueprint $table)
		{
			$table->integer('idsite');
			$table->integer('idgoal');
			$table->string('name', 50);
			$table->string('description')->default('');
			$table->string('match_attribute', 20);
			$table->string('pattern');
			$table->string('pattern_type', 10);
			$table->boolean('case_sensitive');
			$table->boolean('allow_multiple');
			$table->float('revenue', 10, 0);
			$table->boolean('deleted')->default(0);
			$table->primary(['idsite','idgoal']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_goal');
	}

}
