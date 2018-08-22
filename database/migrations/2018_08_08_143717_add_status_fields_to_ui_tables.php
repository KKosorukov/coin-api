<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFieldsToUiTables extends Migration
{
    public function up()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->integer('status')->default(0); // Enabled
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->integer('status')->default(0); // Enabled
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->integer('status')->default(0); // Enabled
        });

        Schema::connection('mysql-ui')->table('projects', function (Blueprint $table) {
            $table->integer('status')->default(0); // Enabled
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::connection('mysql-ui')->table('projects', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
