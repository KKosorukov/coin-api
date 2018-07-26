<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegmentsAdvGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mysql-backoffice')->create('segments-adv_groups', function (Blueprint $table) {
            $table->integer('segment_id');
            $table->integer('adv_group_id');
        });

        $this->_fillLinkedTable();
    }

    /**
     * Fill linked table
     */
    private function _fillLinkedTable() {
        $linkedData = [
            [
                'segment_id' => 1,
                'adv_group_id' => 1
            ],
            [
                'segment_id' => 2,
                'adv_group_id' => 2
            ]
        ];

        DB::connection('mysql-backoffice')->table('segments-adv_groups')->insert($linkedData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('segments-adv_groups');
    }
}
