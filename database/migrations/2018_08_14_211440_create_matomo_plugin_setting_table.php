<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoPluginSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_plugin_setting', function(Blueprint $table)
		{
			$table->string('plugin_name', 60);
			$table->string('setting_name');
			$table->text('setting_value');
			$table->boolean('json_encoded')->default(0);
			$table->string('user_login', 100)->default('');
			$table->index(['plugin_name','user_login'], 'plugin_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_plugin_setting');
	}

}
