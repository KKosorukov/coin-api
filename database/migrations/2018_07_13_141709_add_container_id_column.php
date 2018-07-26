<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \App\Models\Backoffice\Banner;

class AddContainerIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('banners', function (Blueprint $table) {
            $table->integer('container_id')->nullable();
        });

        $this->_changeDummyContainerId();
    }

    /**
     * Change all containers_ids to dummy
     */
    private function _changeDummyContainerId() {
        $banners = Banner::all();
        foreach($banners as $key => $banner) {
            $banner->container_id = 2;
            $banner->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('banners', function (Blueprint $table) {
            $table->dropColumn('container_id');
        });
    }
}
