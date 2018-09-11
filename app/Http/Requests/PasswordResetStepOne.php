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
            'email.required' => trans('adventa-account.email.required'),
            'email.max'  => trans('adventa-account.email.max'),
            'email.email' => trans('adventa-account.email.email'),
            'email.unique' => trans('adventa-account.email.unique'),
            'secret_question_id.required' => trans('adventa-account.secret_question_id.required'),
            'secret_question_id.integer' => trans('adventa-account.secret_question_id.integer'),
            'secret_question_id.secret_question' => trans('adventa-account.secret_question_id.secret_question'),
            'secret_question_answer.required' => trans('adventa-account.secret_question_answer.required'),
            'secret_question_answer.correct_secret_answer' => trans('adventa-account.secret_question_answer.correct_secret_answer'),
        ];
    }
}
