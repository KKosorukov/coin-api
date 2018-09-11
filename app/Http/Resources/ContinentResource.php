<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Continent"
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
 *      description="Название контитента",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="continent_code",
 *      type="string",
 *      description="Код контитента",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="population",
 *      type="string",
 *      description="Популяция (в целых человеках)"
 *   )
 * )
 */

class ContinentResource extends JsonResource
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
            'population' => $this->population
        ];
    }
}
