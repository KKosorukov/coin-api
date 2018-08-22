<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndChangeShortLongDescriptionIntoAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->dropColumn('text');
            $table->text('short_description');
            $table->mediumText('long_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->dropColumn('short_description', 'long_description');
            $table->text('text');
        });
    }
}
