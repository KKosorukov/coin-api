<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateUserContainer extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'bail|required|exists:container_types,id',
            'displayed' => 'required|string|max:50',
            'width' => 'bail|required|integer|max_width|min_width',
            'height' => 'bail|required|integer|max_height|min_height',
            'num_banners' => 'required|integer|max:3|min:1'
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
            'width.required' => 'Обязательно укажите ширину контейнера!',
            'width.integer' => 'Ширина контейнера должна быть целым числом!',
            'width.min_width' => 'Ширина контейнера не может быть меньше, чем :min_width пикселей!',
            'width.max_width' => 'Ширина контейнера не может быть больше, чем :max_width пикселей!',
            'height.required' => 'Обязательно укажите высоту контейнера!',
            'height.integer' => 'Высота контейнера должна быть целым числом!',
            'height.min_height' => 'Высота контейнера не может быть меньше, чем :min_height пикселей!',
            'height.max_height' => 'Высота контейнера не может быть больше, чем :max_height пикселей!',
            'type.required' => 'Выберите тип контейнера!',
            'type.exists' => 'Такой тип контейнера не существует!',
            'displayed.required' => 'Укажите имя для отображения этого контейнера!',
            'displayed.string' => 'Имя контейнера должно быть обязательно строкой!',
            'displayed.max' => 'Имя контейнера не можем превышать 50 символов!',
            'num_banners.integer' => 'Количество баннеров для контейнера должно быть целым числом!',
            'num_banners.required' => 'Введите количество баннеров для контейнера!',
            'num_banners.max' => 'Максимальное количество баннеров в контейнере не может превышать 3!',
            'num_banners.min' => 'Минмальное количество баннеров в контейнере не может быть меньше 1!'
        ];
    }
}
