<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Adv;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Manager"
 *   )
 * )
 */

class ManagerResource extends UserResource
{
    /**
     * @var Adv[]
     */
    private $advs;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        $result = parent::toArray($request);
        $result['advs'] = AdvResource::collection($this->advs);

        return $result;
    }
}