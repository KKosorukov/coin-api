<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class UploadAvatar extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'required|base64image|max:100000'
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
            'avatar.required' => 'Upload a picture in a base64-format!',
            'avatar.base64image' => 'A picture is and incorrect base64-string!',
            'avatar.max' => 'File must be lower than 100Kb!'
        ];
    }
}
