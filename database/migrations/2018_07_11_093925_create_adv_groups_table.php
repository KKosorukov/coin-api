<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\AdvGroup;

class CreateAdvGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('adv_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('campaign_id');
            $table->timestamps();
        });

        $this->_createDummyGroups();
    }


    /**
     * Create dummy groups with advertises
     */
    private function _createDummyGroups() {
        $dummyData = [
            [
                'name' => 'First group',
                'user_id' => 1,
                'campaign_id' => 2
            ],
            [
                'name' => 'Second group',
                'user_id' => 1,
                'campaign_id' => 2
            ]
        ];

        foreach ($dummyData as $item) {
            AdvGroup::create($item);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('adv_groups');
    }
}
