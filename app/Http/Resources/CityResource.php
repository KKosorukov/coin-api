<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="City"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="string",
 *      description="Название города",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="area_code",
 *      type="string",
 *      description="Код области, которому принадлежит город",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="country_code",
 *      type="string",
 *      description="Код страны, которой принадлежит город",
 *      default="available"
 *   )
 * )
 */

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'area_code' => $this->area_code,
            'country_code' => $this->country_code
        ];
    }
}
