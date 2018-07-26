<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->enum('status', [
                0, // On
                1, // Off
            ])->default(0);
            $table->timestamps();
        });

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->integer('project_id');
        });


        $this->_createFirstProjects();

        $this->_bindCampaignsOnProjects();
    }

    /**
     * Bind campaigns to projects
     */
    private function _bindCampaignsOnProjects() {
        $campaigns = \App\Models\Backoffice\Campaign::all();
        foreach ($campaigns as $campaign) {
            $campaign->project_id = rand(1, 2);
            $campaign->user_id = 1;
            $campaign->save();
        }
    }

    /**
     * Create first projects
     */
    private function _createFirstProjects() {
        $projects = [
            [
                'name' => 'First project',
                'user_id' => 1
            ],
            [
                'name' => 'Second project',
                'user_id' => 1
            ]
        ];

        foreach ($projects as $project) {
            \App\Models\Backoffice\Project::create($project);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');

        Schema::connection('mysql-backoffice')->table('campaigns', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });
    }
}
