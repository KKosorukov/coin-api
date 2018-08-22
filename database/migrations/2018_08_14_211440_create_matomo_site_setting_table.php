<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoSiteSettingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_site_setting', function(Blueprint $table)
		{
			$table->integer('idsite')->unsigned();
			$table->string('plugin_name', 60);
			$table->string('setting_name');
			$table->text('setting_value');
			$table->boolean('json_encoded')->default(0);
			$table->index(['idsite','plugin_name'], 'idsite');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_site_setting');
	}

}
