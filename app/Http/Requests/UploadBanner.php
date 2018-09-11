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
           // 'cont_type' => 'required|exists:container_types,name',
            'cont_form' => 'required|exists:container_forms,name'
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
            'banner.required' => trans('adventa-banner.banner.required'),
            'banner.base64image' => trans('adventa-banner.banner.base64image'),
            'cont_type.required' => trans('adventa-banner.cont_type.required'),
            'cont_type.exists' => trans('adventa-banner.cont_type.exists'),
            'cont_form.required' => trans('adventa-banner.cont_form.required'),
            'cont_form.exists' => trans('adventa-banner.cont_form.exists')
        ];
    }
}
