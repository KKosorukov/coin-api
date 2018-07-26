<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice;
use App\Components\ApiCounter;
use App\Models\User;

class AddApiKeyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('users', function (Blueprint $table) {
            $table->string('api_key')->nullable();
        });

        $this->_setDefaultApiKeys();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('users', function (Blueprint $table) {
            $table->dropColumn('api_key');
        });
    }

    /**
     * Set default API keys
     */
    private function _setDefaultApiKeys() {
        $allUsers = User::all();
        foreach ($allUsers as $user) {
            $user->api_key = (new ApiCounter())->generateApiKey();
            $user->save();
        }
    }
}
