<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumShowsNumClicksIntoAdvsUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->integer('num_shows')->default(0);
            $table->integer('num_clicks')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->table('advs', function (Blueprint $table) {
            $table->dropColumn('num_shows');
            $table->dropColumn('num_clicks');
        });

    }
}
