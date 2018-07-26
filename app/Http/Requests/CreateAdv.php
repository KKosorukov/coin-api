<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateAdv extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'campaign_id' => 'required|exists:campaigns,id|owner_of_campaign',
            'adv_type_id' => 'required|exists:adv_types,id',
            'is_dummy' => 'required|boolean',
            'comment' => 'string',
            'picture' => 'base64img',
            'title' => 'required|string',
            'text' => 'string',
            'moderator_comment' => 'string',
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
            'name.required' => 'Введите имя!',
            'name.max' => 'Имя не может превышать 255 символов!',
            'campaign_id.required' => 'Обязательно укажите кампанию!',
            'campaign_id.exists' => 'Кампании, которую вы указали, не существует!',
            'campaign_id.owner_of_campaign' => 'Вы не являетесь хозяином данной кампании!',
            'adv_type_id.required' => 'Тип объявления обязателен!',
            'adv_type_id.exists' => 'Такого типа объявления не существует!',
            'is_dummy.required' => 'Параметр, определяющий статус (заглушка или нет), обязателен!',
            'is_dummy.boolean' => 'Передайте значения 0 или 1!',
            'picture.base64img' => 'Картинка не является корректной base64-строкой!',
            'title.required' => 'Заголовок должен быть обязательно!'
        ];
    }
}
