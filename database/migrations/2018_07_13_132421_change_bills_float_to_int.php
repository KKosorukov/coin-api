<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBillsFloatToInt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->bigInteger('num_tokens')->change();
        });

        $this->_updateData();
    }

    /**
     * Update data and add '00' in every amount of.
     */
    private function _updateData() {
        $bills = \App\Models\Backoffice\Bill::all();
        foreach ($bills as $bill) {
            $bill->num_tokens = $bill->num_tokens['ADT'] * 100;
            $bill->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
