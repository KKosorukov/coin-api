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
            'date_from' => 'required|date_format:Y-m-d h:i:s',
            'date_to' => 'required|date_format:Y-m-d h:i:s',
            'comment' => 'string'
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
            'date_to.date_format' => 'Дата окончания кампании должна быть в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС!'
        ];
    }
}
