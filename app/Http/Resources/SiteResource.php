<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Site"
 *   )
 * )
 */

class SiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);
        $result['is_banner'] = $this->getBooleanFromBase($result, 'is_banner');
        $result['is_text']   = $this->getBooleanFromBase($result, 'is_text');
        $result['is_video']  = $this->getBooleanFromBase($result, 'is_video');
        $result['earnings']  = 100000;
        $result['clicks']    = 500;
        $result['views']     = 100000;
        $result['ctr']       = 1000;
        $result['cpc']       = 2000;
        $result['traffic']   = 1000;
        $result['is_robot']  = 2000;

        return $result;
    }

    /**
     * @param $result
     * @return bool
     */
    private function getBooleanFromBase($result, $key): bool
    {
        return array_key_exists($key, $result) ? (bool)$result[$key] : false;
    }
}
