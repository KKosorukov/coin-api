<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignDueToFromColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->timestamp('date_from')->default(date('Y-m-d h:i:s'));
            $table->timestamp('date_to')->default(date('Y-m-d h:i:s', time() + 3600 * 24 * 10));
        });

        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->timestamp('date_from')->default(date('Y-m-d h:i:s'));
            $table->timestamp('date_to')->default(date('Y-m-d h:i:s', time() + 3600 * 24 * 10));
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
            $table->dropColumn('date_from');
            $table->dropColumn('date_due');
        });

        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->dropColumn('date_from');
            $table->dropColumn('date_due');
        });
    }
}
