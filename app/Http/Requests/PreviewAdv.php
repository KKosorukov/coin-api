<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PreviewAdv extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'container_type' => 'required|exists:container_types,id',
            'container_form' => 'required|exists:container_forms,id',
            'banner_type' => 'required|exists:banner_types,id',
            'banner_form' => 'required|exists:banner_forms,id',
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
            'container_type.required' => 'Обязательно укажите тип контейнера!',
            'container_form.required' => 'Обязательно укажите форму контейнера!',
            'banner_type.required' => 'Обязательно укажите тип баннера!',
            'banner_form.required' => 'Обязательно укажите форму баннера!',
            'container_type.exists' => 'Не существует такого типа контейнера!',
            'container_form.exists' => 'Не существует такой формы контейнера!',
            'banner_type.exists' => 'Не существует такого типа баннера!',
            'banner_form.exists' => 'Не существует такой формы баннера!'
        ];
    }
}
