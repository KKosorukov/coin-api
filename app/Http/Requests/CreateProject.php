<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateProject extends ApiFormRequest
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
            'status' => 'required|in:0,1',
            'daily_budget' => 'numeric|min:0|user_daily_budget_limit',
            'budget' => 'numeric|min:0|user_budget_limit',
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
            'name.required' => trans('adventa-project.name.required'),
            'name.max' => trans('adventa-project.name.max'),
            'status.required' => trans('adventa-project.status.required'),
            'status.in' => trans('adventa-project.status.in'),
            'daily_budget.numeric' => trans('adventa-project.daily_budget.numeric'),
            'daily_budget.min' => trans('adventa-project.daily_budget.min'),
            'budget.numeric' => trans('adventa-project.budget.numeric'),
            'budget.min' => trans('adventa-project.budget.min'),
            'budget.user_budget_limit' => trans('adventa-project.budget.user_budget_limit'),
            'daily_budget.user_daily_budget_limit' => trans('adventa-project.daily_budget.user_daily_budget_limit')
        ];
    }
}
