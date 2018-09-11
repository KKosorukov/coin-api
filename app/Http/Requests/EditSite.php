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
            'url.required'       => trans('adventa-site.name.required'),
            'is_text.boolean'    => trans('adventa-site.is_text.boolean'),
            'is_banner.boolean'  => trans('adventa-site.is_banner.boolean'),
            'is_video.boolean'   => trans('adventa-site.is_video.boolean'),
        ];
    }
}