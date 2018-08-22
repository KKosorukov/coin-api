<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentBudgetsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
            $table->integer('current_daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->integer('current_daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
        });

        Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
            $table->integer('current_daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
        });

        Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
            $table->integer('budget')->default(0);
            $table->integer('current_daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
        });


        Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
            $table->integer('current_daily_budget')->default(0);
            $table->integer('current_budget')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(
            Schema::connection('mysql-backoffice')->hasColumn('projects', 'current_budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('projects', 'current_daily_budget')
        ) {
            Schema::connection('mysql-backoffice')->table('projects', function (Blueprint $table) {
                $table->dropColumn(['current_daily_budget', 'current_budget']);
            });
        }

        if(
            Schema::connection('mysql-backoffice')->hasColumn('campaigns', 'current_budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('campaigns', 'current_daily_budget')
        ) {
            Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
                $table->dropColumn(['current_daily_budget', 'current_budget']);
            });
        }

        if(
            Schema::connection('mysql-backoffice')->hasColumn('adv_groups', 'current_budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('adv_groups', 'current_daily_budget')
        ) {
            Schema::connection('mysql-backoffice')->table('adv_groups', function (Blueprint $table) {
                $table->dropColumn(['current_daily_budget', 'current_budget']);
            });
        }

        if(
            Schema::connection('mysql-backoffice')->hasColumn('advs', 'budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('advs', 'current_budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('advs', 'current_daily_budget')
        ) {
            Schema::connection('mysql-backoffice')->table('advs', function (Blueprint $table) {
                $table->dropColumn(['budget', 'current_daily_budget', 'current_budget']);
            });
        }

        if(
            Schema::connection('mysql-backoffice')->hasColumn('campaigns', 'current_budget') &&
            Schema::connection('mysql-backoffice')->hasColumn('campaigns', 'current_daily_budget')
        ) {
            Schema::connection('mysql-ui')->table('campaigns', function (Blueprint $table) {
                $table->dropColumn(['current_daily_budget', 'current_budget']);
            });
        }
    }
}
