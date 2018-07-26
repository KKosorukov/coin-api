<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserdataColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('users', function (Blueprint $table) {
            $table->string('skype_id')->nullable();
            $table->string('telegram_id')->nullable();
            $table->integer('secret_question_id')->nullable();
            $table->string('secret_question_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('users', function (Blueprint $table) {
            $table->dropColumn('skype_id');
            $table->dropColumn('telegram_id');
            $table->dropColumn('secret_question_id');
            $table->dropColumn('secret_question_answer');
        });
    }
}
