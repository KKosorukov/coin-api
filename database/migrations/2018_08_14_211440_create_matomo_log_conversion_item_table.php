<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogConversionItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_log_conversion_item', function(Blueprint $table)
		{
			$table->integer('idsite')->unsigned();
			$table->binary('idvisitor', 8);
			$table->dateTime('server_time');
			$table->bigInteger('idvisit')->unsigned();
			$table->string('idorder', 100);
			$table->integer('idaction_sku')->unsigned();
			$table->integer('idaction_name')->unsigned();
			$table->integer('idaction_category')->unsigned();
			$table->integer('idaction_category2')->unsigned();
			$table->integer('idaction_category3')->unsigned();
			$table->integer('idaction_category4')->unsigned();
			$table->integer('idaction_category5')->unsigned();
			$table->float('price', 10, 0);
			$table->integer('quantity')->unsigned();
			$table->boolean('deleted');
			$table->primary(['idvisit','idorder','idaction_sku']);
			$table->index(['idsite','server_time'], 'index_idsite_servertime');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_log_conversion_item');
	}

}
