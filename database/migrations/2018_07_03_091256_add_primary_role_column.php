<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\Backoffice\Role;

class AddPrimaryRoleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('roles', function (Blueprint $table) {
            $table->boolean('is_default')->nullable();
        });

        $this->_setDefaultAdministratorRole();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->table('roles', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }

    /**
     * Set admin role as default role
     */
    private function _setDefaultAdministratorRole() {
        $adminRole = Role::where('slug', 'administrators')->first();
        $adminRole->is_default = 1;
        $adminRole->save();
    }

}
