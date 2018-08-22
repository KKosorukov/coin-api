<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeoToBannersUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->string('continent_code')->nullable();
            $table->string('country_code')->nullable();
            $table->string('area_code')->nullable();
            $table->string('city')->nullable();
            $table->time('time_end')->nullable();
            $table->time('time_begin')->nullable();
            $table->string('browser_language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->dropColumn('continent_code');
            $table->dropColumn('country_code');
            $table->dropColumn('area_code');
            $table->dropColumn('city');
            $table->dropColumn('time_end');
            $table->dropColumn('time_begin');
            $table->dropColumn('browser_language');
        });
    }
}
