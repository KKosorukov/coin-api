<?php

namespace App\Http\Requests;

use App\Http\Resources\RoleResource;
use App\Models\Backoffice\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends ApiFormRequest
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
            'email' => 'required|email|max:50|unique:users,email',
            'skype_id' => 'nullable|max:50',
            'telegram_id' => 'nullable|max:30',
            'password' => 'required|max:30',
            'password_repeat' => 'required|same:password',
            'secret_question_id' => 'required|integer|secret_question',
            'secret_question_answer' => 'required|min:5|max:255',
            'role' => 'required|string|role_exists|non_admin',
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
            'email.required' => trans('adventa-account.email.required'),
            'email.max'  => trans('adventa-account.email.max'),
            'email.email' => trans('adventa-account.email.email'),
            'email.unique' => trans('adventa-account.email.unique'),
            'password.required' => trans('adventa-account.password.required'),
            'password.max' => trans('adventa-account.password.max'),
            'password_repeat.same' => trans('adventa-account.password_repeat.same'),
            'password_repeat.required' => trans('adventa-account.password_repeat.required'),
            'secret_question_id.required' => trans('adventa-account.secret_question_id.required'),
            'secret_question_id.integer' => trans('adventa-account.secret_question_id.integer'),
            'secret_question_id.secret_question' => trans('adventa-account.secret_question_id.secret_question'),
            'secret_question_answer.required' => trans('adventa-account.secret_question_answer.required'),
            'secret_question_answer.min' => trans('adventa-account.secret_question_answer.min'),
            'role.required' => trans('adventa-account.role.required'),
            'role.role_exists' => trans('adventa-account.role.role_exists'),
            'role.non_admin' => trans('adventa-account.role.non_admin'),
            'skype_id.max' => trans('adventa-account.skype_id.max'),
            'telegram_id.max' => trans('adventa-account.telegram_id.max'),
            'timezone_id.required' => 'Укажите часовой пояс!',
            'timezone_id.exists' => 'Часового пояса с таким ID не существует!'
        ];
    }
}
