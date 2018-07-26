<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetStepOne extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:50|email',
            'secret_question_id' => 'required|integer|secret_question',
            'secret_question_answer' => 'required|max:255|correct_secret_answer'
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
            'email.required' => 'Почта должна быть введена!',
            'email.max'  => 'Почта не может превышать 50 символов!',
            'email.email' => 'Формат почты некорректный.',
            'email.unique' => 'Такой пользователь уже существует! Возможно, Вам требуется сбросить пароль, чтобы войти?',
            'secret_question_id.required' => 'Выберите секретный вопрос!',
            'secret_question_id.integer' => 'Секретный вопрос: неверный формат!',
            'secret_question_id.secret_question' => 'Такого секретного вопроса не существует!',
            'secret_question_answer.required' => 'Ответ на секретный вопрос должен быть дан!',
            'secret_question_answer.correct_secret_answer' => 'Ответ или вопрос даны некорректно!'
        ];
    }
}
