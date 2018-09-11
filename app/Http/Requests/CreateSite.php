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
            'url.required'       => trans('adventa-site.name.required'),
            'is_text.boolean'    => trans('adventa-site.is_text.boolean'),
            'is_banner.boolean'  => trans('adventa-site.is_banner.boolean'),
            'is_video.boolean'   => trans('adventa-site.is_video.boolean'),
        ];
    }
}