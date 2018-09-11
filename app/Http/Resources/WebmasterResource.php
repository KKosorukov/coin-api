<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Site;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Webmaster"
 *   )
 * )
 */

class WebmasterResource extends UserResource
{
    /**
     * @var Site[]
     */
//    private $sites;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        $result = parent::toArray($request);
        $result['sites'] = SiteResource::collection($this->sites);

        return $result;
    }
}
