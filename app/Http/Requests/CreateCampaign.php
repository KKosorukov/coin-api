<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateCampaign extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'date_from' => 'required|date_format:Y-m-d H:i:s',
            'date_to' => 'required|date_format:Y-m-d H:i:s',
            'comment' => 'string',
            'daily_budget' => 'numeric|min:0|project_daily_budget_limit',
           // 'budget' => 'numeric|min:0|project_budget_limit', // @TODO In the future this can be uncommented, because the logic is here
            'budget' => 'numeric|min:0|user_budget_limit',
            'project_id' => 'required|owner_of_project',
        ];
    }

    /**
     * Messages on errors
     *
     * @return array
     */

    public function messages()
    {
        return [
            'name.required' => trans('adventa-campaign.name.required'),
            'name.max' => trans('adventa-campaign.name.max'),
            'date_from.required' => trans('adventa-campaign.date_from.required'),
            'date_to.required' => trans('adventa-campaign.date_to.required'),
            'date_from.date_format' => trans('adventa-campaign.date_from.date_format'),
            'date_to.date_format' => trans('adventa-campaign.date_to.date_format'),
            'daily_budget.numeric' => trans('adventa-campaign.daily_budget.numeric'),
            'daily_budget.min' => trans('adventa-campaign.daily_budget.min'),
            'budget.numeric' => trans('adventa-campaign.budget.numeric'),
            'budget.min' => trans('adventa-campaign.budget.min'),
            'daily_budget.project_daily_budget_limit' => trans('adventa-campaign.daily_budget.project_daily_budget_limit'),
           // 'budget.project_budget_limit' => 'Бюджет кампании не может превышать бюджет проекта!', // @TODO In the future this can be uncommented, because the logic is here
            'budget.user_budget_limit' => trans('adventa-campaign.budget.user_budget_limit'),
            'project_id.required' => trans('adventa-campaign.project_id.required'),
            'project_id.owner_of_project' => trans('adventa-campaign.project_id.owner_of_project')
        ];
    }
}
