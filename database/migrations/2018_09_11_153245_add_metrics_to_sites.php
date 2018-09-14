<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetricsToSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('sites', function (Blueprint $table) {
            $table->unsignedInteger('num_clicks')->default(0);
            $table->unsignedInteger('num_shows')->default(0);
        });

        Schema::connection('mysql-ui')->table('sites', function (Blueprint $table) {
            $table->unsignedInteger('num_clicks')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('sites', function (Blueprint $table) {
            $table->dropColumn(['num_clicks', 'num_shows']);
        });

        Schema::connection('mysql-ui')->table('sites', function (Blueprint $table) {
            $table->dropColumn(['num_clicks']);
        });
    }
}
