<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogConversionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_log_conversion', function(Blueprint $table)
		{
			$table->bigInteger('idvisit')->unsigned();
			$table->integer('idsite')->unsigned();
			$table->binary('idvisitor', 8);
			$table->dateTime('server_time');
			$table->integer('idaction_url')->unsigned()->nullable();
			$table->bigInteger('idlink_va')->unsigned()->nullable();
			$table->integer('idgoal');
			$table->integer('buster')->unsigned();
			$table->string('idorder', 100)->nullable();
			$table->smallInteger('items')->unsigned()->nullable();
			$table->text('url', 65535);
			$table->smallInteger('visitor_days_since_first')->unsigned()->nullable();
			$table->smallInteger('visitor_days_since_order')->unsigned()->nullable();
			$table->boolean('visitor_returning')->nullable();
			$table->integer('visitor_count_visits')->unsigned();
			$table->string('referer_keyword')->nullable();
			$table->string('referer_name', 70)->nullable();
			$table->boolean('referer_type')->nullable();
			$table->string('config_device_brand', 100)->nullable();
			$table->string('config_device_model', 100)->nullable();
			$table->boolean('config_device_type')->nullable();
			$table->string('location_city')->nullable();
			$table->char('location_country', 3)->nullable();
			$table->decimal('location_latitude', 9, 6)->nullable();
			$table->decimal('location_longitude', 9, 6)->nullable();
			$table->char('location_region', 3)->nullable();
			$table->float('revenue', 10, 0)->nullable();
			$table->float('revenue_discount', 10, 0)->nullable();
			$table->float('revenue_shipping', 10, 0)->nullable();
			$table->float('revenue_subtotal', 10, 0)->nullable();
			$table->float('revenue_tax', 10, 0)->nullable();
			$table->string('custom_var_k1', 200)->nullable();
			$table->string('custom_var_v1', 200)->nullable();
			$table->string('custom_var_k2', 200)->nullable();
			$table->string('custom_var_v2', 200)->nullable();
			$table->string('custom_var_k3', 200)->nullable();
			$table->string('custom_var_v3', 200)->nullable();
			$table->string('custom_var_k4', 200)->nullable();
			$table->string('custom_var_v4', 200)->nullable();
			$table->string('custom_var_k5', 200)->nullable();
			$table->string('custom_var_v5', 200)->nullable();
			$table->primary(['idvisit','idgoal','buster']);
			$table->unique(['idsite','idorder'], 'unique_idsite_idorder');
			$table->index(['idsite','server_time'], 'index_idsite_datetime');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_log_conversion');
	}

}
