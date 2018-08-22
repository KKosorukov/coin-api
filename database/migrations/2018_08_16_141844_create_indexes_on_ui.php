<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexesOnUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table((new App\Models\UI\Adv)->getTable(), function (Blueprint $table) {
            $table->index('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\AdvGroup)->getTable(), function (Blueprint $table) {
            $table->index('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\Campaign)->getTable(), function (Blueprint $table) {
            $table->index('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\Project)->getTable(), function (Blueprint $table) {
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->table((new App\Models\UI\Adv)->getTable(), function (Blueprint $table) {
            $table->dropIndex('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\AdvGroup)->getTable(), function (Blueprint $table) {
            $table->dropIndex('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\Campaign)->getTable(), function (Blueprint $table) {
            $table->dropIndex('status');
        });

        Schema::connection('mysql-ui')->table((new App\Models\UI\Project)->getTable(), function (Blueprint $table) {
            $table->dropIndex('status');
        });
    }
}
