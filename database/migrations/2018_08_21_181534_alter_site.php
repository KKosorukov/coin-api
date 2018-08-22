<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->boolean('is_text')->default(true)->change();
            $table->boolean('is_video')->default(true)->change();
            $table->boolean('is_banner')->default(true)->change();
            $table->unsignedBigInteger('balance')->default(0)->change();
            $table->string('host')->default('0.0.0.0')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->boolean('is_text');
            $table->boolean('is_video');
            $table->boolean('is_banner');
            $table->boolean('balance');
            $table->string('host');
        });
    }
}
