<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\SecretQuestion;

class CreateSecretQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('secret_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
        });

        $this->createQuestions();
    }

    /**
     * Create questions for registration
     */
    private function createQuestions() {
        $questions = [
            'Любимый корм Вашей собаки?',
            'Девичья фамилия вашей фамилии?',
            'Год рождения вышей кошки?'
        ];

        foreach ($questions as $q) {
            SecretQuestion::create([
                'question' => $q
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->dropIfExists('secret_questions');
    }
}
