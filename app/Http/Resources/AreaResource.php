<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Area"
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
 *      description="Код страны, которой принадлежит область",
 *      default="available"
 *   )
 * )
 */

class AreaResource extends JsonResource
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
            'country_code' => $this->country_code,
            'area_code' => $this->area_code
        ];
    }
}
