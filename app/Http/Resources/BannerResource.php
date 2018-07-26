<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Adv;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * This is Banner Resource
 *
 * Class BannerResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Banner"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="title",
 *      type="string",
 *      description="Заголовок баннера",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="description",
 *      type="boolean",
 *      description="Описание баннера",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="path",
 *      type="boolean",
 *      description="Путь до баннера",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="user",
 *      type="object",
 *      description="Пользователь, которому принадлежит данный баннер",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/UserResource")
 *   ),
 *   @SWG\Property(
 *      property="adv",
 *      type="integer",
 *      description="Объявление, которое данный баннер на текущий момент содержит",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/AdvResource")
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


class BannerResource extends JsonResource
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
            'title' => $this->title,
            'path' => $this->path,
            'user' => $this->user,
            'description' => $this->description,
            'adv' => $this->adv,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
