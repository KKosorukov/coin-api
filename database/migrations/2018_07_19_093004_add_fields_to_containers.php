<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToContainers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('containers', function (Blueprint $table) {
            $table->integer('container_type_id')->nullable();
            $table->integer('container_form_id')->nullable();
        });

        $this->_fillContainerFields();
    }

    /**
     * Fill container fields by dummy banner data
     */
    private function _fillContainerFields() {
        $records = \App\Models\Backoffice\Container::all();
        $fillData = [
            [
                'container_type_id' => 1, // Vertical
                'container_form_id' => 1 // Inline
            ],
            [
                'container_type_id' => 2, // Horizontal
                'container_form_id' => 2 // Popup
            ],
            [
                'container_type_id' => 2, // Horizontal
                'container_form_id' => 1 // Inline
            ],
            [
                'container_type_id' => 1, //  Vertical
                'container_form_id' => 2 // Popup
            ]
        ];

        $num = count($records);

        // Get them simple variants
        for($i = 0; $i < $num; $i++) {
            $records[$i]->container_type_id = $fillData[$i]['container_type_id'];
            $records[$i]->container_form_id = $fillData[$i]['container_form_id'];
            $records[$i]->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('containers', function (Blueprint $table) {
            $table->dropColumn('container_type_id');
            $table->dropColumn('container_form_id');
        });
    }
}
