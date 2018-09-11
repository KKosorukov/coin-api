<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateSegment extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'type' => 'required|in:0,1',
            'params' => 'required|check_segment_params',
            'comment' => 'string',
            'is_private' => 'required|in:0,1' // 0 is private (not displayed in list), 1 displays in table
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
            'name.required' => trans('adventa-segment.name.required'),
            'name.max' => trans('adventa-segment.name.max'),
            'status.required' => trans('adventa-segment.status.required'),
            'status.in' => trans('adventa-segment.status.in'),
            'params.required' => trans('adventa-segment.params.required'),
            'params.json' => trans('adventa-segment.params.json'),
            'params.check_segment_params' => trans('adventa-segment.params.check_segment_params'),
            'type.in' => trans('adventa-segment.type.in'),
            'type.required' => trans('adventa-segment.type.required'),
            'is_private.required' => trans('adventa-segment.is_private.required'),
            'is_private.in' => trans('adventa-segment.is_private.in'),
        ];
    }
}
