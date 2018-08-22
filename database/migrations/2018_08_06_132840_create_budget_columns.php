<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
            $table->integer('daily_budget');
            $table->integer('budget');
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->integer('budget');
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->integer('daily_budget');
            $table->integer('budget');
        });

        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->integer('budget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
            $table->dropColumn(['daily_budget', 'budget']);
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['budget']);
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn(['daily_budget', 'budget']);
        });


        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['budget']);
        });
    }
}
