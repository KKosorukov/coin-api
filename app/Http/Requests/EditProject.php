<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class EditProject extends ApiFormRequest
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
            'name.required' => 'Введите имя!',
            'name.max' => 'Имя не может превышать 255 символов!',
            'status.required' => 'Обязательно укажите статус!',
            'status.in' => 'Статус может принимать одно из двух значений: 0 или 1!',
            'daily_budget.numeric' => 'Значение должно быть числом!',
            'daily_budget.min' => 'Значение должно быть больше 0!',
            'budget.numeric' => 'Значение должно быть числом!',
            'budget.min' => 'Значение должно быть больше нуля!',
            'budget.user_budget_limit' => 'Значение бюджета не может превышать остаток суммы на счету!',
            'daily_budget.user_daily_budget_limit' => 'Значение дневного бюджета не может превышать значение общего бюджета!'
        ];
    }
}