<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


use App\Models\Backoffice\Project;
use App\Models\Backoffice\Campaign;
use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\Adv;

class ChangeTestBugdets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            $project->budget = 10000;
            $project->daily_budget = 100;
            $project->save();
        }

        $campaigns = Campaign::all();
        foreach ($campaigns as $campaign) {
            $campaign->budget = 1000;
            $campaign->daily_budget = 50;
            $campaign->save();
        }

        $advGroups = AdvGroup::all();
        foreach ($advGroups as $advGroup) {
            $advGroup->budget = 100;
            $advGroup->daily_budget = 25;
            $advGroup->save();
        }

        $advs = Adv::all();
        foreach ($advs as $adv) {
            $adv->budget = 100;
            $adv->daily_budget = 25;
            $adv->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
