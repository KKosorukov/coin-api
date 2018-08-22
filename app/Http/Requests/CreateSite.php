<?php

namespace App\Http\Requests;

class CreateSite extends ApiFormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'url'       => 'required|max:255',
            'is_text'   => 'boolean',
            'is_banner' => 'boolean',
            'is_video'  => 'boolean',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'url.required'       => 'Введите URL сайта.',
            'is_text.boolean'    => 'Передайте значения `false` или `true`!',
            'is_banner.boolean'  => 'Передайте значения `false` или `true`!',
            'is_video.boolean'   => 'Передайте значения `false` или `true`!',
        ];
    }
}