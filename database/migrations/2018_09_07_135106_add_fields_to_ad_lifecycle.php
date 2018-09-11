<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdLifecycle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->unsignedInteger('num_shows')->default(0);
            $table->unsignedInteger('num_clicks')->default(0);
            $table->unsignedInteger('expenses')->default(0);
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->unsignedInteger('num_shows')->default(0);
            $table->unsignedInteger('num_clicks')->default(0);
            $table->unsignedInteger('expenses')->default(0);
        });

        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->unsignedInteger('expenses')->default(0);
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->unsignedInteger('num_shows')->default(0);
            $table->unsignedInteger('num_clicks')->default(0);
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->unsignedInteger('num_shows')->default(0);
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
        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['num_shows', 'num_clicks', 'expenses']);
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn(['num_shows', 'num_clicks', 'expenses']);
        });

        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->dropColumn(['expenses']);
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['num_shows', 'num_clicks']);
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn(['num_shows', 'num_clicks']);
        });
    }
}
