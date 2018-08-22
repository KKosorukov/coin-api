<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogLinkVisitActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_log_link_visit_action', function(Blueprint $table)
		{
			$table->bigInteger('idlink_va', true)->unsigned();
			$table->integer('idsite')->unsigned();
			$table->binary('idvisitor', 8);
			$table->bigInteger('idvisit')->unsigned()->index('index_idvisit');
			$table->integer('idaction_url_ref')->unsigned()->nullable()->default(0);
			$table->integer('idaction_name_ref')->unsigned()->nullable();
			$table->float('custom_float', 10, 0)->nullable();
			$table->dateTime('server_time');
			$table->char('idpageview', 6)->nullable();
			$table->smallInteger('interaction_position')->unsigned()->nullable();
			$table->integer('idaction_name')->unsigned()->nullable();
			$table->integer('idaction_url')->unsigned()->nullable();
			$table->integer('time_spent_ref_action')->unsigned()->nullable();
			$table->integer('idaction_event_action')->unsigned()->nullable();
			$table->integer('idaction_event_category')->unsigned()->nullable();
			$table->integer('idaction_content_interaction')->unsigned()->nullable();
			$table->integer('idaction_content_name')->unsigned()->nullable();
			$table->integer('idaction_content_piece')->unsigned()->nullable();
			$table->integer('idaction_content_target')->unsigned()->nullable();
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
		Schema::drop('matomo_log_link_visit_action');
	}

}
