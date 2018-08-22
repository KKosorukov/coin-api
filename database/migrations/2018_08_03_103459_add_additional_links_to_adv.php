<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalLinksToAdv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->string('additional_adv_url_1')->nullable();
            $table->string('additional_adv_url_2')->nullable();
            $table->string('additional_adv_url_3')->nullable();
            $table->string('additional_adv_url_4')->nullable();
            $table->string('additional_adv_url_desc_1')->nullable();
            $table->string('additional_adv_url_desc_2')->nullable();
            $table->string('additional_adv_url_desc_3')->nullable();
            $table->string('additional_adv_url_desc_4')->nullable();
        });

        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->string('additional_adv_url_1')->nullable();
            $table->string('additional_adv_url_2')->nullable();
            $table->string('additional_adv_url_3')->nullable();
            $table->string('additional_adv_url_4')->nullable();
            $table->string('additional_adv_url_desc_1')->nullable();
            $table->string('additional_adv_url_desc_2')->nullable();
            $table->string('additional_adv_url_desc_3')->nullable();
            $table->string('additional_adv_url_desc_4')->nullable();
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
            $table->dropColumn('additional_adv_url_1');
            $table->dropColumn('additional_adv_url_2');
            $table->dropColumn('additional_adv_url_3');
            $table->dropColumn('additional_adv_url_4');
            $table->dropColumn('additional_adv_url_desc_1');
            $table->dropColumn('additional_adv_url_desc_2');
            $table->dropColumn('additional_adv_url_desc_3');
            $table->dropColumn('additional_adv_url_desc_4');
        });

        Schema::connection('mysql-ui')->table('banners', function (Blueprint $table) {
            $table->dropColumn('additional_adv_url_1');
            $table->dropColumn('additional_adv_url_2');
            $table->dropColumn('additional_adv_url_3');
            $table->dropColumn('additional_adv_url_4');
            $table->dropColumn('additional_adv_url_desc_1');
            $table->dropColumn('additional_adv_url_desc_2');
            $table->dropColumn('additional_adv_url_desc_3');
            $table->dropColumn('additional_adv_url_desc_4');
        });
    }
}
