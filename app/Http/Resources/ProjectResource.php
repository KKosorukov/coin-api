<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\User;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * This is Project Resource
 *
 * Class ProjectResource
 * @package App\Http\Resources
 */

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Project"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="user",
 *      type="object",
 *      description="Пользователь-хозяин",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/UserResource")
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="string",
 *      description="Имя проекта",
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
 *      property="status",
 *      type="string",
 *      description="Статус",
 *      enum={"0 - включен","1 - выключен"},
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="budget",
 *      type="integer",
 *      description="Бюджет общий",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="daily_budget",
 *      type="integer",
 *      description="Бюджет суточный",
 *      default="available"
 *   )
 * )
 */

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => $this->user,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'status' => $this->status,
            'budget' => $this->budget,
            'daily_budget' => $this->daily_budget
        ];
    }
}
