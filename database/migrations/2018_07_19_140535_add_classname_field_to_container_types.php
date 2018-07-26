<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassnameFieldToContainerTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('container_types', function (Blueprint $table) {
            $table->string('classname')->nullable();
        });

        $this->_fillContainerTypesClassnameFields();
    }

    /**
     * Fill container types by classname
     */
    public function _fillContainerTypesClassnameFields() {
        $types = [
            [
                'name' => 'vertical',
                'classname' => 'App\Models\Backoffice\ContainerTypes\Vertical',
            ],
            [
                'name' => 'horizontal',
                'classname' => 'App\Models\Backoffice\ContainerTypes\Horizontal'
            ]
        ];

        $containerTypes = \App\Models\Backoffice\ContainerType::all();
        $num = count($containerTypes);
        for ($i = 0; $i < $num; $i++) {
            $containerTypes[$i]->classname = $types[$i]['classname'];
            $containerTypes[$i]->name = $types[$i]['name'];
            $containerTypes[$i]->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('container_types', function (Blueprint $table) {
            $table->dropColumn('classname');
        });
    }
}
