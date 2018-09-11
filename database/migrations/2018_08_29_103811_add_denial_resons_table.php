<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\DenialReason;

class AddDenialResonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denial_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text', 255);
        });

        Schema::create('sites-denial_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->integer('denial_reason_id')->unsigned();
            $table->timestamp('denial_date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('cascade');

            $table->foreign('denial_reason_id')
                ->references('id')
                ->on('denial_reasons')
                ->onDelete('cascade');
        });

        $reasons = [
            [
                'text' => 'A mismatch theme'
            ],
            [
                'text' => 'Violation of legislation'
            ],
            [
                'text' => 'Incorrect design'
            ],
            [
                'text' => 'Violation of legislation'
            ],
            [
                'text' => 'Spam'
            ],
            [
                'text' => 'Questionable content'
            ]
        ];

        DenialReason::insert($reasons);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sites-denial_reasons');
        Schema::drop('denial_reasons');
    }
}
