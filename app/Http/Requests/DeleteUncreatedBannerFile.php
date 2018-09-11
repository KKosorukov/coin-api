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
            'path.required' => trans('adventa-adv.path.required'),
            'path.banner_image_exists' => trans('adventa-adv.path.banner_image_exists')
        ];
    }
}
