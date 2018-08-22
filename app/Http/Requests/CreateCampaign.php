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
            'name.required' => 'Введите имя кампании!',
            'name.max' => 'Имя кампании не может быть больше, чем 255 символов!',
            'date_from.required' => 'Введите дату начала кампании!',
            'date_to.required' => 'Введите дату окончания кампании!',
            'date_from.date_format' => 'Дата начала кампании должна быть в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС!',
            'date_to.date_format' => 'Дата окончания кампании должна быть в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС!',
            'daily_budget.numeric' => 'Значение должно быть числом!',
            'daily_budget.min' => 'Значение должно быть больше 0!',
            'budget.numeric' => 'Значение должно быть числом!',
            'budget.min' => 'Значение должно быть больше нуля!',
            'daily_budget.project_daily_budget_limit' => 'Дневной лимит кампании не может превышать дневной лимит проекта!',
           // 'budget.project_budget_limit' => 'Бюджет кампании не может превышать бюджет проекта!', // @TODO In the future this can be uncommented, because the logic is here
            'budget.user_budget_limit' => 'Бюджет кампании не может превышать остаток бюджета пользователя!',
            'project_id.required' => 'Укажите проект!',
            'project_id.owner_of_project' => 'Создавать кампании разрешается только в своих проектах!'
        ];
    }
}
