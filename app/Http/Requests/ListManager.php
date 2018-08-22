<?php

namespace App\Http\Requests;

/**
 */
class ListManager extends ApiFormRequest
{
    /**
     * @var integer
     */
    public $status;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'status'   => 'integer|min:1|max:5',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'status.integer'   => 'status может быть только integer от 1 до 5 включительно.',
        ];
    }
}