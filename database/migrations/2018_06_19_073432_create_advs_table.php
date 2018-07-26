<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\AdvType;
use App\Models\Backoffice\Adv;

class CreateAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('advs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('is_dummy');
            $table->unsignedInteger('adv_type_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('adv_group_id');
            $table->timestamps();
        });

        $this->createDummyAdvertise();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('advs');
    }

    /**
     * Create first dummy advertise
     */
    public function createDummyAdvertise() {
        $defaultType = AdvType::where('is_default_type', 1)->first();
        if(!$defaultType) {
            throw new Exception(404);
        }

        for($i = 0; $i < 2; $i++) {
            $adv = \App\Models\Backoffice\Adv::create([
                'name' => 'Default advertise '.$i,
                'is_dummy' => 1,
                'adv_type_id' => $defaultType->id,
                'campaign_id' => 1,
                'adv_group_id' => 1,
                'user_id' => 1
            ]);
        }
    }
}
