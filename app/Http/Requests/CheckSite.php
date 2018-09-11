<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.07.2018
 * Time: 12:36
 */

namespace App\Http\Requests;

class CheckSite extends ApiFormRequest
{
    /**
     * @var string
     */
    public $url;

    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'url'   => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'url.required'     => trans('adventa-checksite.url.required'),
            'url.active_url'   => trans('adventa-checksite.url.active_url')
        ];
    }
}