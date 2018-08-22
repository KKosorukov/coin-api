<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowcaseStatus extends Migration
{
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->integer('showcase_status')->default(0); // Enabled
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->integer('showcase_status')->default(0); // Enabled
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->integer('showcase_status')->default(0); // Enabled
        });

        Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
            $table->integer('showcase_status')->default(0); // Enabled
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
            $table->dropColumn('showcase_status');
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->dropColumn('showcase_status');
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn('showcase_status');
        });

        Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
            $table->dropColumn('showcase_status');
        });
    }
}
