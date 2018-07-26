<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \App\Models\Backoffice\AdvTypes\AdvBanner;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adv_id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->mediumText('path');
            $table->timestamps();
        });

        $this->createSimpleBanner();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('banners');
    }

    /**
     * Create simple banner as example
     */
    public function createSimpleBanner() {
        $banner = AdvBanner::create([
            'adv_id' => '1',
            'title' => 'Simple example for banner',
            'user_id' => 2,
            'description' => 'This is simple example for banner',
            'path' => '/banners/1/first-banner.png'
        ]);
    }
}
