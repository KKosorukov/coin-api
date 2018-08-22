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
          //  'comment' => 'string', ?!
            'picture' => 'base64image',
            'title' => 'required|string',
            'moderator_comment' => 'string',
            'url' => 'url',
            'additional_adv_url_1' => 'url',
            'additional_adv_url_2' => 'url',
            'additional_adv_url_3' => 'url',
            'additional_adv_url_4' => 'url',
            'additional_adv_url_desc_1' => 'string',
            'additional_adv_url_desc_2' => 'string',
            'additional_adv_url_desc_3' => 'string',
            'additional_adv_url_desc_4' => 'string',
            'sets' => 'required|check_sets',
            'adv_group_id' => 'required|exists:adv_groups,id|owner_of_advgroup',
            'adv_short_desc' => 'string',
            'adv_long_desc' => 'string'
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
            'picture.base64image' => 'Картинка не является корректной base64-строкой!',
            'title.required' => 'Заголовок должен быть обязательно!',
            'additional_adv_url_1.url' => 'Значение должно быть корректным URL!',
            'additional_adv_url_2.url' => 'Значение должно быть корректным URL!',
            'additional_adv_url_3.url' => 'Значение должно быть корректным URL!',
            'additional_adv_url_4.url' => 'Значение должно быть корректным URL!',
            'sets.required' => 'Выберите хотя бы один тип объявления!',
            'sets.check_sets' => 'Не все переданные типы имеют корректные идентификаторы!',
            'comment.string' => 'Комментарий должен быть строкой!',
            'moderator_comment.string' => 'Модераторский комментарий должен быть строкой!',
            'adv_group_id.required' => 'Выберите группу объявлений!',
            'adv_group_id.exists' => 'Такой группы объявлений не существует!'
        ];
    }
}
