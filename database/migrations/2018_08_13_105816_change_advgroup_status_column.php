<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdvgroupStatusColumn extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->enum('status', [
                0, // On
                1, // Off
                2, // On moderation
                3 // Archive
            ])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
