<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AddAdvsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->string('comment')->nullable();
            $table->text('picture')->nullable();
            $table->enum('status_global', [
                0, // On
                1, // Off
                2 // Requires budget
            ])->default(0);
            $table->enum('status_moderation', [
                0, // OK
                1, // On moderation
                2, // Declined
                3 // Changed on moderation: need approve
            ])->default(0);
            $table->integer('num_shows')->default(0);
            $table->integer('num_clicks')->default(0);
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('text')->nullable();
            $table->string('moderator_comment')->nullable();
            $table->integer('daily_budget')->default(50);
        });

        $this->_fillDummyAdvsData();
    }

    /**
     * Fill fields in advs
     */
    public function _fillDummyAdvsData() {

        $faker = Faker\Factory::create();
        $advs = \App\Models\Backoffice\Adv::all();
        foreach($advs as $adv) {
            $adv->url = $faker->url;
            $adv->title = $faker->text(50);
            $adv->text = $faker->text(100);
            $adv->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->dropColumn('comment');
            $table->dropColumn('picture');
            $table->dropColumn('status_global');
            $table->dropColumn('status_moderation');
            $table->dropColumn('num_shows');
            $table->dropColumn('num_clicks');
            $table->dropColumn('url');
            $table->dropColumn('title');
            $table->dropColumn('text');
            $table->dropColumn('moderator_comment');
            $table->dropColumn('daily_budget');
        });
    }
}
