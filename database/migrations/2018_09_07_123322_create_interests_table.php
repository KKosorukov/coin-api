<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Interest;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1 interests
        Schema::connection('mysql-backoffice')->create('interests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);

            $table->unique(['title']);
        });

        $interests = [
            [
                'title' => 'sport'
            ],
            [
                'text' => 'yoga'
            ],
            [
                'text' => 'running'
            ]
        ];

        Interest::insert($interests);

        // 2 sites-interests
        Schema::connection('mysql-backoffice')->create('sites-interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->integer('interest_id')->unsigned();

            $table->unique(['site_id', 'interest_id']);

            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('cascade');

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');
        });

        // 3 advs-interests
        Schema::connection('mysql-backoffice')->create('advs-interests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adv_id')->unsigned();
            $table->integer('interest_id')->unsigned();

            $table->unique(['adv_id', 'interest_id']);

            $table->foreign('adv_id')
                ->references('id')
                ->on('advs')
                ->onDelete('cascade');

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');
        });


        // 4 adv denial reasons
        Schema::create('advs-denial_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adv_id')->unsigned();
            $table->integer('denial_reason_id')->unsigned();
            $table->timestamp('denial_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('adv_id')
                ->references('id')
                ->on('advs')
                ->onDelete('cascade');

            $table->foreign('denial_reason_id')
                ->references('id')
                ->on('denial_reasons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('advs-denial_reasons');

        Schema::connection('mysql-backoffice')->dropIfExists('advs-interests');
        Schema::connection('mysql-backoffice')->dropIfExists('sites-interests');

        Schema::connection('mysql-backoffice')->dropIfExists('interests');
    }
}
