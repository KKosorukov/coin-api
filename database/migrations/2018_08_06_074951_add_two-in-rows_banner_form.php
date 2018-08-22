<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\BannerForm;

class AddTwoInRowsBannerForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $newForm = new BannerForm;
        $newForm->name = 'two-in-row';
        $newForm->classname = 'App\Models\Backoffice\BannerForms\TwoInRow';
        $newForm->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        BannerForm::where([
            'classname' => 'App\Models\Backoffice\BannerForms\TwoInRow'
        ])->delete();
    }
}
