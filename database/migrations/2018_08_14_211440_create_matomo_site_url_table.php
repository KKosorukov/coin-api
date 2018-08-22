<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoSiteUrlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_site_url', function(Blueprint $table)
		{
			$table->integer('idsite')->unsigned();
			$table->string('url');
			$table->primary(['idsite','url']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_site_url');
	}

}
