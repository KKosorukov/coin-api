<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPopulationColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('geo-continent', function (Blueprint $table) {
            $table->unsignedInteger('population')->nullable();
        });

        Schema::connection('mysql-backoffice')->table('geo-country', function (Blueprint $table) {
            $table->unsignedInteger('population')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('geo-continent', function (Blueprint $table) {
            $table->dropColumn('population');
        });

        Schema::connection('mysql-backoffice')->table('geo-country', function (Blueprint $table) {
            $table->dropColumn('population');
        });
    }
}
