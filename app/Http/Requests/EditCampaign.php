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
            'date_from' => 'required|date_format:Y-m-d h:i:s',
            'date_to' => 'required|date_format:Y-m-d h:i:s',
            'comment' => 'string',
            'daily_budget' => 'required|integer|min:0',
            'status_global' => 'required|in:0,1,2,3',
            'status_moderation' => 'required|in:0,1,2,3',
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
            'status_moderation.in' => 'Статус модерации может принимать значения от 0 до 3!'
        ];
    }
}
