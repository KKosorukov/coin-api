<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvUiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->create('advs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('real_id');
            $table->integer('banner_type_id');
            $table->integer('banner_form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->dropIfExists('advs');
    }
}
