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
            'password.required' => trans('adventa-account.password.required'),
            'password.max' => trans('adventa-account.password.max'),
            'password_repeat.same' => trans('adventa-account.password_repeat.same'),
            'password_repeat.required' => trans('adventa-account.password_repeat.required'),
            'code.required' => trans('adventa-account.code.required')
        ];
    }
}
