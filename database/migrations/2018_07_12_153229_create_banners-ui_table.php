<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersUiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('website_id');
            $table->integer('campaign_id');
            $table->integer('advgroup_id')->nullable();
            $table->integer('adv_id')->nullable();
            $table->integer('banner_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->dropIfExists('banners');
    }
}
