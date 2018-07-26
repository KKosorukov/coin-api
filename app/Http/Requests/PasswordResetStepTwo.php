<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetStepTwo extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|max:30',
            'password_repeat' => 'required|same:password',
            'code' => 'required'
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
            'password.required' => 'Введите пароль!',
            'password.max' => 'Пароль не может превышать 30 символов!',
            'password_repeat.same' => 'Пароль и повтор пароля должны совпадать!',
            'password_repeat.required' => 'Повтор пароля должен быть введён!',
            'code.required' => 'Токен должен быть послан!'
        ];
    }
}
