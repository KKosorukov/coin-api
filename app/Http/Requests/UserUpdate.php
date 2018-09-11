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
            'last_name' => 'string|max:50',
            'skype_id' => 'nullable|max:50',
            'telegram_id' => 'nullable|max:30',
            'timezone_id' => 'required|exists:timezones,id'
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
            'first_name.required' => trans('adventa-account.first_name.required'),
            'first_name.max' => trans('adventa-account.first_name.max'),
            'first_name.min' => trans('adventa-account.first_name.min'),
            'last_name.required' => trans('adventa-account.last_name.required'),
            'last_name.max' => trans('adventa-account.last_name.max'),
            'last_name.min' => trans('adventa-account.last_name.min'),
            'skype_id.max' => trans('adventa-account.skype_id.max'),
            'telegram_id.max' => trans('adventa-account.telegram_id.max'),
            'timezone_id.required' => 'Укажите часовой пояс!',
            'timezone_id.exists' => 'Часового пояса с таким ID не существует!'
        ];
    }
}
