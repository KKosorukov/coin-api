<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * This is Advertise type Resource
 *
 * Class AdvTypeResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="AdvertiseType"
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
 *      description="Название типа",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="description",
 *      type="boolean",
 *      description="Описание типа",
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
 *   ),
 *   @SWG\Property(
 *      property="code",
 *      type="string",
 *      description="Исходный код, который представляет тип",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="is_default_type",
 *      type="boolean",
 *      description="Тип объявления по умолчанию или нет",
 *      default="available"
 *   ),
 * )
 */


class AdvTypeResource extends JsonResource
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
            'description' => $this->description,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'code' => $this->code,
            'is_default_type' => $this->is_default_type,
        ];
    }
}
