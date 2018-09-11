<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserContainer extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_id' => 'bail|required|exists:container_types,id',
            'displayed' => 'required|string|max:50',
            'width' => 'bail|required|integer|max_width|min_width',
            'height' => 'bail|required|integer|max_height|min_height',
            'num_banners' => 'required|integer|max:3|min:1'
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
            'width.required' => trans('adventa-container.width.required'),
            'width.integer' =>  trans('adventa-container.width.integer'),
            'width.min_width' =>  trans('adventa-container.width.min_width'),
            'width.max_width' =>  trans('adventa-container.width.max_width'),
            'height.required' =>  trans('adventa-container.height.required'),
            'height.integer' =>  trans('adventa-container.height.integer'),
            'height.min_height' =>  trans('adventa-container.height.min_height'),
            'height.max_height' =>  trans('adventa-container.height.max_height'),
            'type.required' =>  trans('adventa-container.type.required'),
            'type.exists' =>  trans('adventa-container.type.exists'),
            'displayed.required' =>  trans('adventa-container.displayed.required'),
            'displayed.string' =>  trans('adventa-container.displayed.string'),
            'displayed.max' =>  trans('adventa-container.displayed.max'),
            'num_banners.integer' =>  trans('adventa-container.num_banners.integer'),
            'num_banners.required' =>  trans('adventa-container.num_banners.required'),
            'num_banners.max' =>  trans('adventa-container.num_banners.max'),
            'num_banners.min' =>  trans('adventa-container.num_banners.min')
        ];
    }
}
