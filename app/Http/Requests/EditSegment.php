<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class EditSegment extends ApiFormRequest
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
            'type' => 'required|in:0,1',
            'params' => 'required|json|check_segment_params',
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
            'name.required' => 'Введите имя!',
            'name.max' => 'Имя не может превышать 255 символов!',
            'status.required' => 'Обязательно укажите тип!',
            'status.in' => 'Тип может принимать одно из двух значений: 0 или 1!',
            'params.required' => 'Хотя бы один параметр должен быть выбран!',
            'params.json' => 'Параметры должны быть корректной JSON-строкой!',
            'params.check_segment_params' => 'Не все параметры переданы корректно!'
        ];
    }
}
