<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->float('num_tokens');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        $this->createBillExamples();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('bills');
    }

    /**
     * Create examples of bills
     */
    public function createBillExamples() {
        $bills = [
            '23000',
            '25678',
            '345.89'
        ];

        foreach ($bills as $u => $b) {
            \App\Models\Backoffice\Bill::create([
                'user_id' => $u + 1,
                'num_tokens' => $b
            ]);
        }
    }
}
