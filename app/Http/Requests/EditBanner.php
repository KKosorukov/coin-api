<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class EditBanner extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'adv_id' => 'exists:advs,id|owner_of_adv',
            'title' => 'required|string|max:255|min:1',
            'description' => 'string|max:500',
            'path' => 'required|max:50|banner_exists',
            'container_id' => 'exists:containers,id|owner_of_container'
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
            'adv_id.required' => 'Обязательно укажите идентификатор объявления!',
            'adv_id.exists' => 'Такого объявления не существует!',
            'adv_id.owner_of_adv' => 'Вы не являетесь владельцем рекламного объявления!',
            'title.required' => 'Заголовок обязателен. До 255 символов.',
            'title.string' => 'Укажите заголовок! Он должен быть не больше 255 символов',
            'title.max' => 'Заголовок для баннер не может быть больше 255 символов!',
            'title.min' => 'Заголовок для баннера должен быть указан обязательно! До 255 символов.',
            'description.string' => 'Описание должно быть максимум 500 символов!',
            'path.required' => 'Путь до файла должен быть задан!',
            'path.max' => 'Максимальное количество символов в имени файла - 50!',
            'path.banner_exists' => 'Такого баннера не существует в файловой системе!',
            'container_id.exists' => 'Контейнер, который вы выбрали, не существует!',
            'container_id.owner_of_container' => 'Вы не имеете прав для редактирования данного контейнера'
        ];
    }
}
