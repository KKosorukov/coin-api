<?php

namespace App\Components;
/**
 * Class provides all works with showcase's budgets
 *
 * Class Budgetor
 * @package App\Components
 */

use App\Components\Component;

use App\Models\UI\Banner as UIBanner;
use App\Models\UI\Adv as UIAdv;
use App\Models\UI\AdvGroup as UIAdvGroup;
use App\Models\UI\Campaign as UICampaign;
use App\Models\UI\Project as UIProject;
use App\Models\UI\Site as UISite;

use Illuminate\Support\Carbon;

class Budgetor extends Component {
    protected $banner = null;
    protected $adv = null;
    protected $advGroup = null;
    protected $campaign = null;
    protected $project = null;
    protected $site = null;

    public function __construct() {

        parent::__construct();
    }

    /**
     * Set banner for recalc
     */
    public function setBanner(UIBanner $banner) {
        $this->banner = $banner;
        return $this;
    }

    /**
     * Set adv for recalc
     */
    public function setAdv(UIAdv $adv) {
        $this->adv = $adv;
        return $this;
    }

    /**
     * Set adv group for recalc
     */
    public function setAdvGroup(UIAdvGroup $advGroup) {
        $this->advGroup = $advGroup;
        return $this;
    }

    /**
     * Set campaign for recalc
     */
    public function setCampaign(UICampaign $campaign) {
        $this->campaign = $campaign;
        return $this;
    }

    /**
     * Set project for recalc
     */
    public function setProject(UIProject $project) {
        $this->project = $project;
        return $this;
    }

    /**
     * Set site for recalc
     */
    public function setSite(UISite $site) {
        $this->site = $site;
        return $this;
    }

    /**
     * Recalc all sides of showed
     */
    public function recalc() {
        $this->_recalcBanner();
        $this->_recalcAdv();
        $this->_recalcAdvGroup();
        $this->_recalcCampaign();
        $this->_recalcProject();
        $this->_recalcSite();
    }

    /**
     * Recalc ui-side banner budgets
     */
    private function _recalcBanner() {
        // @TODO Here is no params for recalc...?
    }

    private function _recalcEntity($entity, $price) {

        if($entity->status == 0) {
            if($entity->current_budget == 0 ) {  // Append new budget
                $entity->current_budget = $entity->budget;
            }
            if($entity->current_daily_budget == 0) { // Append new current budget
                $entity->current_daily_budget = $entity->daily_budget;
            }

            $entity->current_daily_budget -= $price;
            $entity->current_budget -= $price;

        }

        if($entity->current_daily_budget <= 0 && (time() - strtotime($entity->last_update_time)) >= 86400) { // New day is here...
            if($entity->current_budget > 0) {
                if($entity->current_budget >= $entity->daily_budget) { // If budget is almost over
                    $entity->current_daily_budget = $entity->daily_budget;
                } else {
                    $entity->current_daily_budget = $entity->current_budget;
                }

                $entity->status = 0;

            } else {
                $entity->current_daily_budget = 0;
            }

            $entity->last_update_time = Carbon::now();
        }

        if($entity->current_daily_budget <= 0) {
            $entity->current_daily_budget = 0;
            $entity->status = 1; // Disabled
        }

        if($entity->current_budget <= 0) {
            $entity->current_budget = 0;
            $entity->status = 1; // Disabled
        }

        $entity->save();
    }

    /**
     * Recalc ui-side adv budgets
     */
    private function _recalcAdv() {
        $this->_recalcEntity($this->adv, $this->advGroup->click_price); // @TODO Price is on advGroup. But this can be in the near future on every adv
    }

    /**
     * Recalc ui-side advgroups budgets
     */
    private function _recalcAdvGroup() {
        $this->_recalcEntity($this->advGroup, $this->advGroup->click_price); // @TODO Price is on advGroup. But this can be in the near future on every adv
    }

    /**
     * Recalc ui-side campaign budgets
     */
    private function _recalcCampaign() {
        $this->_recalcEntity($this->campaign, $this->advGroup->click_price); // @TODO Price is on advGroup. But this can be in the near future on every adv
    }

    /**
     * Recalc ui-side project budgets
     */
    private function _recalcProject() {
        $this->_recalcEntity($this->project, $this->advGroup->click_price); // @TODO Price is on advGroup. But this can be in the near future on every adv
    }

    /**
     * Update status, when new day is coming
     */
    public function updateStatusOnNewDay() {
        // Update advs
        UIAdv::where('last_update_time', '<', Carbon::now()->subDays(1))->where('status', '=', 1)->update([
            'last_update_time' => Carbon::now(),
            'status' => 0
        ]);

        // Update advgroups
        UIAdvGroup::where('last_update_time', '<', Carbon::now()->subDays(1))->where('status', '=', 1)->update([
            'last_update_time' => Carbon::now(),
            'status' => 0
        ]);

        // Update campaign
        UICampaign::where('last_update_time', '<', Carbon::now()->subDays(1))->where('status', '=', 1)->update([
            'last_update_time' => Carbon::now(),
            'status' => 0
        ]);

        // Update project
        UIProject::where('last_update_time', '<', Carbon::now()->subDays(1))->where('status', '=', 1)->update([
            'last_update_time' => Carbon::now(),
            'status' => 0
        ]);
    }
}