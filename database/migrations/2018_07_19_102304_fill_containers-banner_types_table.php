<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillContainersBannerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'container_id' => 1,
                'banner_type_id' => 1
            ],
            [
                'container_id' => 1,
                'banner_type_id' => 2
            ],
            [
                'container_id' => 2,
                'banner_type_id' => 3
            ],
            [
                'container_id' => 2,
                'banner_type_id' => 4
            ],
            [
                'container_id' => 2,
                'banner_type_id' => 5
            ],
        ];

        foreach ($data as $item) {
            DB::connection('mysql-backoffice')->table('containers-banner_types')->insert($item);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection('mysql-backoffice')->table('containers-banner_types')->delete();
    }
}
