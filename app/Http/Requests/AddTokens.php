<?php

namespace App\Http\Requests;

/**
 */
class AddTokens extends ApiFormRequest
{
    /**
     * @var integer
     */
//    public $status;
//    public $ids;

    /**
     * @return array
     */
    public function rules()
    {
        return [
//            'status' => 'integer|min:1|max:6'
        ];
    }

    /**
     * @return array
     */
//    public function messages()
//    {
////        return [
////            'status.integer' => 'status может быть только integer от 1 до 6 включительно.'
////        ];
//    }
}
