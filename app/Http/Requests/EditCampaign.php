<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class EditCampaign extends ApiFormRequest
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
            'daily_budget' => 'required|integer|min:0|project_daily_budget_limit',
            //'budget' => 'numeric|min:0|project_budget_limit',  // @TODO In the future this can be uncommented, because the logic is here
            'budget' => 'numeric|min:0|user_budget_limit',
            'status_global' => 'required|in:0,1,2,3',
            'status_moderation' => 'required|in:0,1,2,3',
            'project_id' => 'required|owner_of_project'
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
            'daily_budget.required' => 'Дневной бюджет должен быть обязательно! Если дневного бюджета нет, передавайте 0.',
            'daily_budget.integer' => 'Значение бюджета должно быть целым числом!',
            'daily_budget.min' => 'Значение бюджета не может быть меньше 0!',
            'status_global.required' => 'Глобальный статус кампании должен быть обозначен!',
            'status_global.in' => 'Глобальный статус может принимать значения от 0 до 3!',
            'status_moderation.required' => 'Статус модерации должен быть введён!',
            'status_moderation.in' => 'Статус модерации может принимать значения от 0 до 3!',
            'daily_budget.numeric' => 'Значение должно быть числом!',
            'daily_budget.min' => 'Значение должно быть больше 0!',
            'budget.numeric' => 'Значение должно быть числом!',
            'budget.min' => 'Значение должно быть больше нуля!',
            // 'budget.project_budget_limit' => 'Бюджет кампании не может превышать бюджет проекта!', // @TODO In the future this can be uncommented, because the logic is here
            'budget.user_budget_limit' => 'Бюджет кампании не может превышать остаток бюджета пользователя!',
            'daily_budget.project_daily_budget_limit' => 'Дневной лимит кампании не может превышать дневной лимит проекта!',
            'project_id.required' => 'Укажите проект!',
            'project_id.owner_of_project' => 'Создавать кампании разрешается только в своих проектах!'
        ];
    }
}
