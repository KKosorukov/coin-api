<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class PreviewAdv extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'container_type' => 'required|exists:container_types,id',
            'container_form' => 'required|exists:container_forms,id',
            'banner_type' => 'required|exists:banner_types,id',
            'banner_form' => 'required|exists:banner_forms,id',
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
            'container_type.required' => trans('adventa-adv.container_type.required'),
            'container_form.required' => trans('adventa-adv.container_form.required'),
            'banner_type.required' => trans('adventa-adv.banner_type.required'),
            'banner_form.required' => trans('adventa-adv.banner_form.required'),
            'container_type.exists' => trans('adventa-adv.container_type.exists'),
            'container_form.exists' => trans('adventa-adv.container_form.exists'),
            'banner_type.exists' => trans('adventa-adv.banner_type.exists'),
            'banner_form.exists' => trans('adventa-adv.banner_form.exists')
        ];
    }
}
