<?php

namespace App\Http\Requests;

class GetByPeriod extends ApiFormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'from'   => 'date_format:YYYY-MM-DD',
            'to' => 'date_format:YYYY-MM-DD'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'from.date_format' => 'Incorrect format of date!',
            'to.date_format' => 'Incorrect format of date!'
        ];
    }
}
