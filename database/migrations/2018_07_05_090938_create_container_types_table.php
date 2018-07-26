<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Backoffice\ContainerType;


class CreateContainerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('container_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('min_width')->nullable();
            $table->integer('min_height')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('max_height')->nullable();
            $table->timestamps();
        });

        $this->_createContainerTypes();
    }

    /**
     * Create container types
     */
    private function _createContainerTypes() {
        $containerTypes = [
           [
               'name' => 'vertical',
               'min_height' => 200,
               'max_height' => 500,
           ],
           [
               'name' => 'horizontal',
               'min_width' => 200,
               'max_width' => 500,
           ]
        ];

        foreach ($containerTypes as $containerType) {
            $contTypeModel = new ContainerType();
            $contTypeModel->fill($containerType);
            $contTypeModel->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('container_types');
    }
}
