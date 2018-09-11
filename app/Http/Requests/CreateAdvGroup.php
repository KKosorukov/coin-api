<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateAdvGroup extends ApiFormRequest
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
            'campaign_id' => 'required|exists:campaigns,id|owner_of_campaign',
            'status' => 'integer|in:0,1',
            'daily_budget' => 'numeric|min:0|campaign_daily_budget_limit',
            'budget' => 'numeric|min:0|campaign_budget_limit',
            'click_price' => 'required|min:0|max_click_price',
            'segments' => 'present|array|segments_exists'
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
            'name.required' => trans('adventa-advgroup.name.required'),
            'name.max' => trans('adventa-advgroup.name.max'),
            'campaign_id.required' => trans('adventa-advgroup.campaign_id.required'),
            'campaign_id.exists' => trans('adventa-advgroup.campaign_id.exists'),
            'campaign_id.owner_of_campaign' => trans('adventa-advgroup.campaign_id.owner_of_campaign'),
            'status.required' => trans('adventa-advgroup.status.required'),
            'status.in' => trans('adventa-advgroup.status.in'),
            'daily_budget.numeric' => trans('adventa-advgroup.daily_budget.numeric'),
            'daily_budget.min' => trans('adventa-advgroup.daily_budget.min'),
            'budget.numeric' => trans('adventa-advgroup.budget.numeric'),
            'budget.min' => trans('adventa-advgroup.budget.min'),
            'daily_budget.campaign_daily_budget_limit' => trans('adventa-advgroup.daily_budget.campaign_daily_budget_limit'),
            'budget.campaign_budget_limit' => trans('adventa-advgroup.budget.campaign_budget_limit'),
            'click_price.required' => trans('adventa-advgroup.click_price.required'),
            'click_price.min' => trans('adventa-advgroup.click_price.min'),
            'click_price.max_click_price' => trans('adventa-advgroup.click_price.max_click_price'),
            'segments.array' => trans('adventa-advgroup.segments.array'),
            'segments.segments_exists' => trans('adventa-advgroup.segments.segments_exists'),
            'segments.present' => trans('adventa-advgroup.segments.present')
        ];
    }
}
