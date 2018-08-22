<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoLogVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    DB::Statement('CREATE TABLE matomo_log_visit (
                              idvisit BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                              idsite INTEGER(10) UNSIGNED NOT NULL,
                              idvisitor BINARY(8) NOT NULL,
                              visit_last_action_time DATETIME NOT NULL,
                              config_id BINARY(8) NOT NULL,
                              location_ip VARBINARY(16) NOT NULL,
                                PRIMARY KEY(idvisit),
                                INDEX index_idsite_config_datetime (idsite, config_id, visit_last_action_time),
                                INDEX index_idsite_datetime (idsite, visit_last_action_time),
                                INDEX index_idsite_idvisitor (idsite, idvisitor)
                              ) ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_log_visit');
	}

}
