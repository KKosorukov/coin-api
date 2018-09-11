<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Timezone;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Timezone"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ"
 *   ),
 *   @SWG\Property(
 *      property="description",
 *      type="string",
 *      description="Описание"
 *   ),
 *    @SWG\Property(
 *      property="offset",
 *      type="string",
 *      description="Сдвиг в часах"
 *   )
 * )
 */

class TimezoneResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return parent::toArray($this);
    }
}