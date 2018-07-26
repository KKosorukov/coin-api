<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Container;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('user_id');
            $table->string('width');
            $table->string('height');
            $table->string('num_banners');
            $table->string('displayed');
            $table->timestamps();
        });

        $this->_createFirstContainers();
    }


    private function _createFirstContainers() {
        $containers = [
            [
                'type_id' => 1,
                'user_id' => 2,
                'width' => 200,
                'height' => 400,
                'num_banners' => 2,
                'displayed' => 'First example (vertical inline)'
            ],
            [
                'type_id' => 1,
                'user_id' => 2,
                'width' => 450,
                'height' => 150,
                'num_banners' => 3,
                'displayed' => 'Second example (horizontal popup)'
            ],
            [
                'type_id' => 1,
                'user_id' => 2,
                'width' => 450,
                'height' => 150,
                'num_banners' => 3,
                'displayed' => 'Third example (horizontal inline)'
            ],
            [
                'type_id' => 1,
                'user_id' => 2,
                'width' => 200,
                'height' => 400,
                'num_banners' => 2,
                'displayed' => 'Fourth example (vertical popup)'
            ],
        ];

        foreach ($containers as $container) {
            Container::create($container);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('containers');
    }
}
