<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \App\Models\Backoffice\Segment;

class CreateSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('segments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment')->nullable();
            $table->enum('type', [
                0, // Include
                1, // Exclude
            ])->default(0);
            $table->json('params');
            $table->string('name');
        });

        $this->_fillSegments();
    }

    /**
     * Fill segments
     */
    private function _fillSegments() {
        $segments = [
            [
                'comment' => 'First segment comment',
                'params' => '{"name":"First segment","type":"0","params":{"geo":[{"continent_code":"AS","country_code":"RU","area_code":"TVE","city":"1028"}], "time":[{"time_begin":"9:00","time_end":"15:00"},{"time_begin":"18:00","time_end":"19:00"}],"language":["en-US","ru-RU"]}}',
                'name' => 'First segment'
            ],
            [
                'comment' => 'Second segment comment',
                'params' => '{"name":"Second segment","type":"0","params":{"geo":[{"continent_code":"AS","country_code":"RU","area_code":"SAK","city":"5543"}], "time":[{"time_begin":"2:00","time_end":"5:00"},{"time_begin":"12:00","time_end":"14:00"}],"language":["en-US","ru-RU"]}}',
                'name' => 'Second segment'
            ]
        ];

        foreach ($segments as $segment) {
            $segmentModel = new Segment();
            $segmentModel->comment = $segment['name'];
            $segmentModel->params = $segment['params'];
            $segmentModel->name = $segment['comment'];
            $segmentModel->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('segments');
    }
}
