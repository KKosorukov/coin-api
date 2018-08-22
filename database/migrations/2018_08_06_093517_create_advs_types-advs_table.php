<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvsTypesAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('advs_types-advs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('adv_id');
            $table->integer('adv_type_id');
        });

        if(Schema::connection('mysql-backoffice')->hasColumn('advs', 'adv_type_id')) {
            Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
                $table->dropColumn('adv_type_id');
            });
        }

        // Fill all adv types
        $this->_fillAdvTypes();

        $this->_fillAdvTypesToAdvs();
    }

    /**
     * Fill adv types to advs example
     */
    public function _fillAdvTypesToAdvs() {
        $advTypesToAdvs = [
            [
                'adv_id' => 1,
                'adv_type_id' => 1
            ],
            [
                'adv_id' => 2,
                'adv_type_id' => 2
            ]
        ];

        foreach ($advTypesToAdvs as $item) {
            DB::connection('mysql-backoffice')->table('advs_types-advs')->insert($item);
        }
    }

    /**
     * Fill all real adv types
     */
    public function _fillAdvTypes() {
        DB::connection('mysql-backoffice')->table('adv_types')->truncate();

        $types = [
            [
                'title' => 'Картинка',
                'description' => 'Объявление, которое представляет собой только картинку',
                'code' => '',
                'is_default_type' => 0,
            ],
            [
                'title' => 'Картинка + текст',
                'description' => 'Объявление, которое представляет собой картинку + текст',
                'code' => '',
                'is_default_type' => 0,
            ],
            [
                'title' => 'Только текст',
                'description' => 'Объявление, которое представляет только текст',
                'code' => '',
                'is_default_type' => 0,
            ],
            [
                'title' => 'Видео',
                'description' => 'Объявление, которое представляет собой видеоконтент',
                'code' => '',
                'is_default_type' => 0,
            ],
            [
                'title' => 'Аудио',
                'description' => 'Объявление, которое представляет собой аудио, которое проигрывается фоном',
                'code' => '',
                'is_default_type' => 0,
            ],
        ];

        foreach($types as $type) {
            $newType = new \App\Models\Backoffice\AdvType();
            $newType->title = $type['title'];
            $newType->description = $type['description'];
            $newType->code = $type['code'];
            $newType->is_default_type = $type['is_default_type'];
            $newType->save();
         }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('advs_types-advs');
    }
}
