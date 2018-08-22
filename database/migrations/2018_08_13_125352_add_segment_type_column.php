<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSegmentTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('segments', function (Blueprint $table) {
            $table->integer('is_private')->default(0); // Private segments are not displayed into all table
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('segments', function (Blueprint $table) {
            $table->dropColumn(['is_private']);
        });
    }
}
