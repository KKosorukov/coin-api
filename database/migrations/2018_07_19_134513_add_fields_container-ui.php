<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsContainerUi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-ui')->table('containers', function (Blueprint $table) {
            $table->string('container_type_name')->nullable();
            $table->string('container_form_name')->nullable();
            $table->string('container_type_classname')->nullable();
            $table->string('container_form_classname')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-ui')->table('containers', function (Blueprint $table) {
            $table->dropColumn('container_type_name');
            $table->dropColumn('container_form_name');
            $table->dropColumn('container_type_classname');
            $table->dropColumn('container_form_classname');
        });
    }
}
