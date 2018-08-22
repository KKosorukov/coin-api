<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProbabilityToBannersUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->float('probability', 17, 15)->default(0);
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
            $table->dropColumn('probability');
        });
    }
}
