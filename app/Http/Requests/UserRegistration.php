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
            'last_name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'skype_id' => 'nullable|max:50',
            'telegram_id' => 'nullable|max:30',
            'password' => 'required|max:30',
            'password_repeat' => 'required|same:password',
            'secret_question_id' => 'required|integer|secret_question',
            'secret_question_answer' => 'required|min:5|max:255',
            'role' => 'required|string|role_exists|non_admin'
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
            'email.required' => 'Почта должна быть введена!',
            'email.max'  => 'Почта не может превышать 50 символов!',
            'email.email' => 'Формат почты некорректный.',
            'email.unique' => 'Такой пользователь уже существует! Возможно, Вам требуется сбросить пароль, чтобы войти?',
            'password.required' => 'Введите пароль!',
            'password.max' => 'Пароль не может превышать 30 символов!',
            'password_repeat.same' => 'Пароль и повтор пароля должны совпадать!',
            'password_repeat.required' => 'Повтор пароля должен быть введён!',
            'secret_question_id.required' => 'Выберите секретный вопрос!',
            'secret_question_id.integer' => 'Секретный вопрос: неверный формат!',
            'secret_question_id.secret_question' => 'Такого секретного вопроса не существует!',
            'secret_question_answer.required' => 'Ответ на секретный вопрос должен быть дан!',
            'secret_question_answer.min' => 'Минимальное количество для ответа на секретный вопрос - 5!',
            'role.required' => 'Роль пользователя должна быть определена!',
            'role.role_exists' => 'Извините, такой роли не существует!',
            'role.non_admin' => 'Эта роль недоступна для присвоения новому пользователю.',
            'skype_id.max' => 'Skype ID не может быть больше, чем 30 символов!',
            'telegram_id.max' => 'Telegram ID не может быть больше, чем 30 символов!'
        ];
    }
}
