<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClickPriceToAdvgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->integer('click_price')->default(2);
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->integer('click_price')->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('click_price');
        });

        Schema::connection('mysql-ui')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('click_price');
        });
    }
}
