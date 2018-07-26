<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvTextBannersUiColumn extends Migration
{
    public function up()
    {
        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->text('adv_text')->nullable();
            $table->text('adv_url')->nullable();
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
            $table->dropColumn('adv_text');
            $table->dropColumn('adv_url');
        });
    }
}
