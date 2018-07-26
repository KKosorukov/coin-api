<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Base class for all API requests
 *
 * Class ApiFormRequest
 * @package App\Http\Requests
 */

class ApiFormRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'messages' => [
                'errors' => $validator->errors()
            ]
        ], 422));
    }
}
