<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiFormRequest;

class CreateAdv extends ApiFormRequest
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
            'campaign_id' => 'required|exists:campaigns,id|owner_of_campaign',
            'adv_type_id' => 'required|exists:adv_types,id',
            'is_dummy' => 'required|boolean',
          //  'comment' => 'string', ?!
            'picture' => 'base64image',
            'title' => 'required|string',
            'moderator_comment' => 'string',
            'url' => 'url',
            'additional_adv_url_1' => 'url',
            'additional_adv_url_2' => 'url',
            'additional_adv_url_3' => 'url',
            'additional_adv_url_4' => 'url',
            'additional_adv_url_desc_1' => 'string',
            'additional_adv_url_desc_2' => 'string',
            'additional_adv_url_desc_3' => 'string',
            'additional_adv_url_desc_4' => 'string',
            'sets' => 'required|check_sets',
            'adv_group_id' => 'required|exists:adv_groups,id|owner_of_advgroup',
            'short_description' => 'string',
            'long_description' => 'string'
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
            'name.required' => trans('adventa-adv.name.required'),
            'name.max' => trans('adventa-adv.name.max'),
            'campaign_id.required' => trans('adventa-adv.campaign_id.required'),
            'campaign_id.exists' => trans('adventa-adv.campaign_id.exists'),
            'campaign_id.owner_of_campaign' => trans('adventa-adv.campaign_id.owner_of_campaign'),
            'adv_type_id.required' => trans('adventa-adv.adv_type_id.required'),
            'adv_type_id.exists' => trans('adventa-adv.adv_type_id.exists'),
            'is_dummy.required' => trans('adventa-adv.is_dummy.required'),
            'is_dummy.boolean' => trans('adventa-adv.is_dummy.boolean'),
            'picture.base64image' => trans('adventa-adv.picture.base64image'),
            'title.required' => trans('adventa-adv.title.required'),
            'additional_adv_url_1.url' => trans('adventa-adv.additional_adv_url_1.url'),
            'additional_adv_url_2.url' => trans('adventa-adv.additional_adv_url_2.url'),
            'additional_adv_url_3.url' => trans('adventa-adv.additional_adv_url_3.url'),
            'additional_adv_url_4.url' => trans('adventa-adv.additional_adv_url_4.url'),
            'sets.required' => trans('adventa-adv.sets.required'),
            'sets.check_sets' => trans('adventa-adv.sets.check_sets'),
            'comment.string' => trans('adventa-adv.comment.string'),
            'moderator_comment.string' => trans('adventa-adv.moderator_comment.string'),
            'adv_group_id.required' => trans('adventa-adv.adv_group_id.required'),
            'adv_group_id.exists' => trans('adventa-adv.adv_group_id.exists'),
            'short_description.string' => trans('adventa-adv.short_description.string'),
            'long_description.string' => trans('adventa-adv.long_description.string')
        ];
    }
}
