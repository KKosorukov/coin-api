<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Banner;

class FillDummyIntoBackofficeBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Banner::destroy([1]);

        $bannerData = [
            [
                'adv_id' => 1,
                'title' => 'Banner example 1',
                'description' => 'Banner example description 1',
                'path' => '0ca88d976c4a0333bddbe69433dafec9.jpg',
                'user_id' => 1
            ],
            [
                'adv_id' => 1,
                'title' => 'Banner example 2',
                'description' => 'Banner example description 2',
                'path' => '6d6a0ddbcef1e9e9722d6e3509096e6d.jpg',
                'user_id' => 1
            ],
            [
                'adv_id' => 1,
                'title' => 'Banner example 3',
                'description' => 'Banner example description 3',
                'path' => '070c24ff31f674876b702c2c6f08d0cf.png',
                'user_id' => 1
            ],
            [
                'adv_id' => 1,
                'title' => 'Banner example 4',
                'description' => 'Banner example description 4',
                'path' => 'e49c942c9427dc5a2de2ec1d5b6cbdee.jpg',
                'user_id' => 1
            ]
        ];

        foreach ($bannerData as $item) {
            $newBannerModel = new Banner;
            $newBannerModel->fill($item);
            $newBannerModel->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Banner::where('id', '>', 0)->delete();
    }
}
