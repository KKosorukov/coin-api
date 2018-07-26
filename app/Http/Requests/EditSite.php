<?php

namespace App\Http\Requests;


/**
 * @property int id
 * @property bool is_text
 * @property bool is_banner
 * @property bool is_video
 */
class EditSite extends ApiFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
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
            'is_text.boolean'   => 'Передайте значения `false` или `true`!',
            'is_banner.boolean' => 'Передайте значения `false` или `true`!',
            'is_video.boolean'  => 'Передайте значения `false` или `true`!',
        ];
    }
}