<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMatomoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Да, такое бывает. Матома научилась ставить свои миграции сама.
        Schema::drop('matomo_access');
        Schema::drop('matomo_goal');
        Schema::drop('matomo_log_action');
        Schema::drop('matomo_log_conversion');
        Schema::drop('matomo_log_conversion_item');
        Schema::drop('matomo_log_link_visit_action');
        Schema::drop('matomo_log_profiling');
        Schema::drop('matomo_log_visit');
        Schema::drop('matomo_logger_message');
        Schema::drop('matomo_option');
        Schema::drop('matomo_plugin_setting');
        Schema::drop('matomo_privacy_logdata_anonymizations');
        Schema::drop('matomo_report');
        Schema::drop('matomo_segment');
        Schema::drop('matomo_sequence');
        Schema::drop('matomo_session');
        Schema::drop('matomo_site');
        Schema::drop('matomo_site_setting');
        Schema::drop('matomo_site_url');
        Schema::drop('matomo_user');
        Schema::drop('matomo_user_dashboard');
        Schema::drop('matomo_user_language');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
