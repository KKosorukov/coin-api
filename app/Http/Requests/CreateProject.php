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
            'status.in' => 'Статус может принимать одно из двух значений: 0 или 1!'
        ];
    }
}
