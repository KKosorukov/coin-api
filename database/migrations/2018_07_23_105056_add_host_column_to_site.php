<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Site;

class AddHostColumnToSite extends Migration
{
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('sites', function (Blueprint $table) {
            $table->string('host', 15);
        });

        $this->_fillSitesByDummy();
    }

    /**
     * Fill dummy data to sites
     */
    private function _fillSitesByDummy() {
        $faker = Faker\Factory::create();

        $data = [
            [
                'user_id' => 2,
                'url' => $faker->domainName,
                'is_test' => 0,
                'host' => $faker->ipv4,
                'is_text' => $faker->boolean,
                'is_banner' => $faker->boolean,
                'is_video' => $faker->boolean,
                'balance' => $faker->randomNumber(4),
                'status' => 1
            ],
            [
                'user_id' => 2,
                'url' => $faker->safeEmailDomain,
                'is_test' => 0,
                'host' => $faker->ipv4,
                'is_text' => $faker->boolean,
                'is_banner' => $faker->boolean,
                'is_video' => $faker->boolean,
                'balance' => $faker->randomNumber(4),
                'status' => 1
            ],
            [
                'user_id' => 2,
                'url' => $faker->safeEmailDomain,
                'is_test' => 0,
                'host' => $faker->ipv4,
                'is_text' => $faker->boolean,
                'is_banner' => $faker->boolean,
                'is_video' => $faker->boolean,
                'balance' => $faker->randomNumber(4),
                'status' => 1
            ],
            [
                'user_id' => 2,
                'url' => $faker->safeEmailDomain,
                'is_test' => 0,
                'host' => $faker->ipv4,
                'is_text' => $faker->boolean,
                'is_banner' => $faker->boolean,
                'is_video' => $faker->boolean,
                'balance' => $faker->randomNumber(4),
                'status' => 1
            ]
        ];

        foreach ($data as $item) {
            Site::create($item);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('sites', function (Blueprint $table) {
            $table->dropColumn('host');
        });

        // @TODO Truncate all data
        Schema::connection('mysql-backoffice')->table('sites', function (Blueprint $table) {
            //$table->truncate();
        });
    }
}
