<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateBanner extends ApiFormRequest
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
            'path' => 'required|max:50|banner_exists'
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
            'adv_id.required' => trans('adventa-banner.adv_id.required'),
            'adv_id.exists' => trans('adventa-banner.adv_id.exists'),
            'adv_id.owner_of_adv' => trans('adventa-banner.adv_id.owner_of_adv'),
            'title.required' => trans('adventa-banner.title.required'),
            'title.string' => trans('adventa-banner.title.string'),
            'title.max' => trans('adventa-banner.title.max'),
            'title.min' => trans('adventa-banner.title.min'),
            'description.string' => trans('adventa-banner.description.string'),
            'path.required' => trans('adventa-banner.path.required'),
            'path.max' => trans('adventa-banner.path.max'),
            'path.banner_exists' => trans('adventa-banner.path.banner_exists')
        ];
    }
}
