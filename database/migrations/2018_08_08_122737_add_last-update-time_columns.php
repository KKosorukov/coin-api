<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastUpdateTimeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->timestamp('last_update_time')->default(date('Y-m-d H:i:s', time()));
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->timestamp('last_update_time')->default(date('Y-m-d H:i:s', time()));
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->timestamp('last_update_time')->default(date('Y-m-d H:i:s', time()));
        });

        Schema::connection('mysql-ui')->table('projects', function (Blueprint $table) {
            $table->timestamp('last_update_time')->default(date('Y-m-d H:i:s', time()));
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
            $table->dropColumn('last_update_time');
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('last_update_time');
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn('last_update_time');
        });

        Schema::connection('mysql-ui')->table('projects', function (Blueprint $table) {
            $table->dropColumn('last_update_time');
        });
    }
}
