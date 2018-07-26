<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Campaign;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->timestamps();
        });

        $this->_createFirstCampaigns();
    }

    /**
     * Create first campaign
     */
    private function _createFirstCampaigns() {
        $campaigns = [
            [
                'name' => 'First campaign',
                'user_id' => 1,
            ],
            [
                'name' => 'Second campaign',
                'user_id' => 1
            ]
        ];

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('campaigns');
    }
}
