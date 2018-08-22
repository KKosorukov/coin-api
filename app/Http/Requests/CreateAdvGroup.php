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
            'name.required' => 'Введите имя!',
            'name.max' => 'Имя не может превышать 255 символов!',
            'campaign_id.required' => 'Обязательно укажите кампанию!',
            'campaign_id.exists' => 'Кампании, которую вы указали, не существует!',
            'campaign_id.owner_of_campaign' => 'Вы не являетесь хозяином данной кампании!',
            'status.required' => 'Обязательно укажите статус!',
            'status.in' => 'Статус может принимать одно из двух значений: 0 (включён) или 1 (выключен)!',
            'daily_budget.numeric' => 'Значение должно быть числом!',
            'daily_budget.min' => 'Значение должно быть больше 0!',
            'budget.numeric' => 'Значение должно быть числом!',
            'budget.min' => 'Значение должно быть больше нуля!',
            'daily_budget.campaign_daily_budget_limit' => 'Дневной лимит группы объявлений не может превышать дневной лимит кампании!',
            'budget.campaign_budget_limit' => 'Бюджет группы объявлений не может превышать бюджет кампании!',
            'click_price.required' => 'Указание цены за клик обязательно!',
            'click_price.min' => 'Цена за клик не может быть меньше нуля!',
            'click_price.max_click_price' => 'Цена за клик не может превышать бюджет создаваемой или редактируемой группы!',
            'segments.present' => 'Передайте параметр сегмента! Это должен быть минимум пустой массив [] !',
            'segments.array' => 'Тип передаваемого параметра должен быть массивом!',
            'segments.segments_exists' => 'Не все указанные сегменты существуют!'
        ];
    }
}
