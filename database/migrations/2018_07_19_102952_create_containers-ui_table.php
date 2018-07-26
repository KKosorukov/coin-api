<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainersUiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); // Webmaster's ID
            $table->integer('width');
            $table->integer('height');
            $table->integer('container_type_id');
            $table->integer('container_form_id');
            $table->integer('num_banners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->dropIfExists('containers');
    }
}
