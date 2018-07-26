<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class EditAdvGroup extends ApiFormRequest
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
            'status' => 'required|in:0,1'
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
            'status.in' => 'Статус может принимать одно из двух значений: 0 (включён) или 1 (выключен)!'
        ];
    }
}
