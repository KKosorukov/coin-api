<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannersUiShortLongDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->dropColumn('adv_text');
            $table->text('adv_short_desc')->nullable();
            $table->mediumText('adv_long_desc')->nullable();
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
            $table->dropColumn('adv_short_desc', 'adv_long_desc');
            $table->text('adv_text')->nullable();
        });
    }
}
