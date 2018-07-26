<?php

namespace App\Http\Requests;

use App\Http\Resources\RoleResource;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cont_type' => 'sometimes|exists:container_types,name',
            'cont_form' => 'sometimes|exists:container_forms,name'
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
            'cont_type.exists' => 'Неверное указание типа контейнера! Выберите vertical или horizontal',
            'cont_form.exists' => 'Неверное указание формы представления контейнера! Должен быть inline или popup!'
        ];
    }
}
