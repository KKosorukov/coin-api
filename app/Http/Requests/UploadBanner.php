<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class UploadBanner extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banner' => 'required|base64image',
           // 'cont_type' => 'required|exists:container_types,name',
            'cont_form' => 'required|exists:container_forms,name'
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
            'banner.required' => 'Обязательно передайте base64-строку баннера!',
            'banner.base64image' => 'Base64-строка некорректна!',
            'cont_type.required' => 'Тип контейнера обязателен!',
            'cont_type.exists' => 'Тип контейнера, который вы указали, не существует! Укажите vertical или horizontal!',
            'cont_form.required' => 'Форма контейнера обязательна!',
            'cont_form.exists' => 'Форма контейнера, которую вы указали, не существует! Укажите inline или popup!'
        ];
    }
}
