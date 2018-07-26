<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Role"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="permissions",
 *      type="string",
 *      description="Права доступа роли",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="string",
 *      description="Имя роли",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="slug",
 *      type="string",
 *      description="Символьный ключ (уникальный)",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="is_default",
 *      type="integer",
 *      description="Роль, создаваемая в системе по умолчанию нет?",
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

class RoleResource extends JsonResource
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
            'permissions' => $this->permissions,
            'slug' => $this->slug,
            'name' => $this->name,
            'is_default' => $this->is_default,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at
        ];
    }
}
