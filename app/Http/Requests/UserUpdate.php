<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:1|max:50',
            'last_name' => 'required|max:50',
            'skype_id' => 'nullable|max:50',
            'telegram_id' => 'nullable|max:30'
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
            'first_name.required' => 'Имя должно быть введено!',
            'first_name.max' => 'Имя не может быть больше 50 символов!',
            'first_name.min' => 'Имя должно состоять хотя бы из одной буквы!',
            'last_name.required' => 'Фамилия должна быть введена!',
            'last_name.max' => 'Фамилия не может быть больше 50 символов!',
            'last_name.min' => 'Фамилия должна состоять хотя бы из одной буквы!',
            'skype_id.max' => 'Skype ID не может быть больше, чем 30 символов!',
            'telegram_id.max' => 'Telegram ID не может быть больше, чем 30 символов!'
        ];
    }
}
