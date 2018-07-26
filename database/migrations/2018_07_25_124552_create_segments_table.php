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
            $table->string('comment');
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
                'params' => '{"city" : "Moscow", "browser" : "IE", "time_begin" : "19:00", "time_end" : "21:00"}',
                'name' => 'First segment'
            ],
            [
                'comment' => 'Second segment comment',
                'params' => '{"city" : "Saint Petersburg", "browser" : "Firefox", "time_begin" : "12:00", "time_end" : "16:00"}',
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
