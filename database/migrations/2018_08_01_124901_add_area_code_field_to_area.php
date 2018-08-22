<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaCodeFieldToArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('geo-area', function (Blueprint $table) {
            $table->string('area_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('geo-area', function (Blueprint $table) {
            $table->dropColumn('area_code');
        });
    }
}
