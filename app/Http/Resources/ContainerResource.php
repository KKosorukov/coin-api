<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Container;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * This is Container Resource
 *
 * Class ContainerResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Container"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="type",
 *      type="object",
 *      description="Тип контейнера",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/AdvTypeResource")
 *   ),
 *   @SWG\Property(
 *      property="user",
 *      type="object",
 *      description="Пользователь-хозяин",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/UserResource")
 *   ),
 *    @SWG\Property(
 *      property="width",
 *      type="integer",
 *      description="Ширина",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="height",
 *      type="integer",
 *      description="Высота",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="num_banners",
 *      type="integer",
 *      description="Количество баннеров в контейнере",
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


class ContainerResource extends JsonResource
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
            'type' => $this->type,
            'user' => $this->user,
            'width' => $this->width,
            'height' => $this->height,
            'num_banners' => $this->num_banners,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
