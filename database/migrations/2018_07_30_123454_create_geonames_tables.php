<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeonamesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('geo-continent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('continent_code');
        });

        Schema::connection('mysql-backoffice')->create('geo-country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('continent_code');
            $table->string('country_code');
        });

        Schema::connection('mysql-backoffice')->create('geo-area', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country_code');
        });

        Schema::connection('mysql-backoffice')->create('geo-city', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('country_code');
            $table->string('area_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('geo-continent');
        Schema::connection('mysql-backoffice')->dropIfExists('geo-country');
        Schema::connection('mysql-backoffice')->dropIfExists('geo-area');
        Schema::connection('mysql-backoffice')->dropIfExists('geo-city');
    }
}
