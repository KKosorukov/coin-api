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
            'banner.base64image' => 'Base64-строка некорректна!'
        ];
    }
}
