<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBudgetsToAdvsUiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->integer('budget')->default(0);
            $table->integer('daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
            $table->integer('current_daily_budget')->default(0);
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