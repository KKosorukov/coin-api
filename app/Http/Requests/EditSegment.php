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
            'params' => 'required|check_segment_params',
            'comment' => 'string',
            'is_private' => 'required|in:0,1' // 0 is private (not displayed in list), 1 displays in table
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
            'params.check_segment_params' => 'Не все параметры переданы корректно!',
            'type.required' => 'Параметр типа должен принимать значения 0 или 1! (включение или исключение)',
            'type.in' => 'Параметр типа должен принимать значения 0 или 1! (включение или исключение)',
            'is_private.required' => 'Параметр частного или общего отображения должен быть обязательно!',
            'is_private.in' => 'Параметр может быть либо 0 (не отображается в общем листе), либо 1 (отображается в общем листе)'
        ];
    }
}
