<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\ContainerForm;
use App\Models\Backoffice\BannerType;
use App\Models\Backoffice\BannerForm;

class CreateCfBtBfTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('container_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Name of the form: popup or inline
            $table->string('classname'); // Name of class, which handles this containerForm
        });

        Schema::connection('mysql-backoffice')->create('banner_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('width');
            $table->integer('height');
        });

        Schema::connection('mysql-backoffice')->create('banner_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Name of the form: carousel, three in row...
            $table->string('classname'); // Name of class, which handles this bannerForm
        });

        $this->_createContainerForms();
        $this->_createBannerTypes();
        $this->_createBannerForms();
    }

    /**
     * Create all container forms
     */
    private function _createContainerForms() {
        $forms = [
            [
                'name' => 'inline',
                'classname' => 'App\Models\Backoffice\ContainerForms\Inline'
            ],
            [
                'name' => 'popup',
                'classname' => 'App\Models\Backoffice\ContainerForms\Popup'
            ]
        ];

        foreach ($forms as $form) {
            $newForm = new ContainerForm;
            $newForm->fill($form);
            $newForm->save();
        }
    }

    /**
     * Create all banner types
     */
    private function _createBannerTypes() {
        $types = [
            [
                'width' => 200,
                'height' => 200
            ],
            [
                'width' => 240,
                'height' => 400
            ],
            [
                'width' => 250,
                'height' => 250
            ],
            [
                'width' => 250,
                'height' => 360
            ],
            [
                'width' => 300,
                'height' => 250
            ],
            [
                'width' => 336,
                'height' => 280
            ],
            [
                'width' => 120,
                'height' => 600
            ],
            [
                'width' => 160,
                'height' => 600
            ],
            [
                'width' => 300,
                'height' => 1050
            ],
            [
                'width' => 468,
                'height' => 60
            ],
            [
                'width' => 728,
                'height' => 90
            ],
            [
                'width' => 930,
                'height' => 180
            ],
            [
                'width' => 970,
                'height' => 90
            ],
            [
                'width' => 980,
                'height' => 120
            ]
        ];

        foreach ($types as $type) {
            $typeModel = new BannerType;
            $typeModel->fill($type);
            $typeModel->save();
        }
    }

    /**
     * Create all banner forms
     */
    private function _createBannerForms() {
        $forms = [
            [
                'name' => 'simple',
                'classname' => 'App\Models\Backoffice\BannerForms\Simple'
            ],
            [
                'name' => 'carousel',
                'classname' => 'App\Models\Backoffice\BannerForms\Carousel'
            ],
            [
                'name' => 'three-in-row',
                'classname' => 'App\Models\Backoffice\BannerForms\ThreeInRow'
            ]
        ];

        foreach ($forms as $form) {
            $formModel = new BannerForm;
            $formModel->fill($form);
            $formModel->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('container_forms');
        Schema::connection('mysql-backoffice')->dropIfExists('banner_types');
        Schema::connection('mysql-backoffice')->dropIfExists('banner_forms');
    }
}
