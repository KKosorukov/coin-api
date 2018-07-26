<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('adv_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->text('code');
            $table->integer('is_default_type'); // [ 0 or 1, 0 - non-default, 1 - is default ]
            $table->timestamps();
        });

        /**
         * Creating default type of Adv
         */
        $this->createDefaultType();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('adv_types');
    }

    /**
     * Create default type of advertise
     */
    private function createDefaultType() {
        $advType = \App\Models\Backoffice\AdvType::create([
            'title' => 'Default type for everyone',
            'description' => 'This type is using by everyone if anyone shows default Ad',
            'code' => 'dummy',
            'is_default_type' => '1'
        ]);
    }
}
