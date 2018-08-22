<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDummyBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql-backoffice')->table((new \App\Models\Backoffice\Banner)->getTable())->insert([
            'id' => 0,
            'user_id' => -1,
            'adv_id' => -1,
            'title' => \Faker\Provider\Lorem::text(100),
            'description' => \Faker\Provider\Lorem::text(255),
            'path' => 'dummy.png'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Backoffice\Banner::find(['id' => 0])->delete();
    }
}
