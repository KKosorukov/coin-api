<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropsBannersUiColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->integer('banner_form_id')->nullable();
            $table->integer('banner_type_id')->nullable();
            $table->integer('container_form_id')->nullable();
            $table->integer('container_type_id')->nullable();
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
            $table->dropColumn('banner_form_id');
            $table->dropColumn('banner_type_id');
            $table->dropColumn('container_form_id');
            $table->dropColumn('container_type_id');
        });
    }
}
