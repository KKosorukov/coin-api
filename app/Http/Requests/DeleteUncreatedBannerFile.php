<?php

namespace App\Http\Requests;

use App\Http\Resources\RoleResource;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUncreatedBannerFile extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'path' => 'required|banner_image_exists'
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
            'path.required' => 'Путь до файла должен быть указан!',
            'path.banner_image_exists' => 'Такого файла не существует.'
        ];
    }
}
