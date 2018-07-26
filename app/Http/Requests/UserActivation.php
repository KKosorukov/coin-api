<?php

namespace App\Http\Requests;

use App\Http\Resources\RoleResource;
use Illuminate\Foundation\Http\FormRequest;

class UserActivation extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|exists:users,id'
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
            'user.required' => 'Пользователь должен быть указан!',
            'user.exists' => 'Такого пользователя не существует.'
        ];
    }
}
