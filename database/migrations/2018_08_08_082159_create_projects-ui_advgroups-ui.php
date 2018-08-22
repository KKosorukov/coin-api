<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsUiAdvgroupsUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('real_id');
            $table->integer('budget');
            $table->integer('daily_budget');
            $table->integer('current_budget');
            $table->integer('current_daily_budget');
        });

        Schema::connection('mysql-ui')->create('adv_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('real_id');
            $table->integer('budget');
            $table->integer('daily_budget');
            $table->integer('current_budget');
            $table->integer('current_daily_budget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->dropIfExists('projects');
        Schema::connection('mysql-ui')->dropIfExists('adv_groups');
    }
}
