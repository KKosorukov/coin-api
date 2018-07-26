<?php

namespace App\Http\Resources;

use App\Models\Backoffice\ContainerType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * This is ContainerType Resource
 *
 * Class ContainerTypeResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="ContainerType"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="integer",
 *      description="Внутренний ключ типа контейнера",
 *      default="available"
 *   ),
 *    @SWG\Property(
 *      property="min_width",
 *      type="integer",
 *      description="Минимальная ширина",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="min_height",
 *      type="integer",
 *      description="Минимальная высота",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="max_width",
 *      type="integer",
 *      description="Максимальная ширина",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="max_height",
 *      type="integer",
 *      description="Максмальная высота",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="created_at",
 *      type="string",
 *      description="Время создания",
 *      default="available",
 *      format="date-time"
 *   ),
 *   @SWG\Property(
 *      property="updated_at",
 *      type="string",
 *      description="Время последнего изменения",
 *      default="available",
 *      format="date-time"
 *   )
 * )
 */

class ContainerTypeResource extends JsonResource
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
            'name' => $this->type_id,
            'min_width' => $this->min_width,
            'min_height' => $this->min_height,
            'max_width' => $this->max_width,
            'max_height' => $this->max_height,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
