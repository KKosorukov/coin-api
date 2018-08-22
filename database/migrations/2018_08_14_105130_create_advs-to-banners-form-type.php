<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvsToBannersFormType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('advs-banner_forms-banner_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_form_id')->nullable();
            $table->integer('banner_type_id')->nullable();
            $table->integer('container_form_id')->nullable();
            $table->integer('container_type_id')->nullable();
            $table->string('alias');
            $table->integer('adv_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('advs-banner_forms-banner_types');
    }
}
