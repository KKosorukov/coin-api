<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoSiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_site', function(Blueprint $table)
		{
			$table->increments('idsite');
			$table->string('name', 90);
			$table->string('main_url');
			$table->dateTime('ts_created')->nullable();
			$table->boolean('ecommerce')->nullable()->default(0);
			$table->boolean('sitesearch')->nullable()->default(1);
			$table->text('sitesearch_keyword_parameters', 65535);
			$table->text('sitesearch_category_parameters', 65535);
			$table->string('timezone', 50);
			$table->char('currency', 3);
			$table->boolean('exclude_unknown_urls')->nullable()->default(0);
			$table->text('excluded_ips', 65535);
			$table->text('excluded_parameters', 65535);
			$table->text('excluded_user_agents', 65535);
			$table->string('group', 250);
			$table->string('type');
			$table->boolean('keep_url_fragment')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_site');
	}

}
