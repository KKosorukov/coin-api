<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatomoPrivacyLogdataAnonymizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matomo_privacy_logdata_anonymizations', function(Blueprint $table)
		{
			$table->bigInteger('idlogdata_anonymization', true)->unsigned();
			$table->text('idsites', 65535)->nullable();
			$table->dateTime('date_start');
			$table->dateTime('date_end');
			$table->boolean('anonymize_ip')->default(0);
			$table->boolean('anonymize_location')->default(0);
			$table->boolean('anonymize_userid')->default(0);
			$table->text('unset_visit_columns', 65535);
			$table->text('unset_link_visit_action_columns', 65535);
			$table->text('output', 16777215)->nullable();
			$table->dateTime('scheduled_date')->nullable();
			$table->dateTime('job_start_date')->nullable()->index('job_start_date');
			$table->dateTime('job_finish_date')->nullable();
			$table->string('requester', 100)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matomo_privacy_logdata_anonymizations');
	}

}
