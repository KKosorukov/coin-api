<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Country"
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
 *      description="Название страны",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="country_code",
 *      type="string",
 *      description="Код страны",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="continent_code",
 *      type="string",
 *      description="Код контитента, которому принадлежит страна",
 *      default="available"
 *   )
 * )
 */

class CountryResource extends JsonResource
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
            'continent_code' => $this->continent_code,
            'country_code' => $this->country_code
        ];
    }
}
