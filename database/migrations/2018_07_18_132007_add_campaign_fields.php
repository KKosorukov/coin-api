<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->string('comment')->nullable();
            $table->enum('status_global', [
                0, // On
                1, // Off
                2, // Requires set-up
                3 // Requires budget
            ])->default(0);
            $table->enum('status_moderation', [
                0, // OK
                1, // On moderation
                2, // Declined
                3 // Changed on moderation: need approve
            ])->default(0);
            $table->integer('daily_budget')->default(50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('status_global');
            $table->dropColumn('status_moderation');
            $table->dropColumn('daily_budget');
        });
    }
}
