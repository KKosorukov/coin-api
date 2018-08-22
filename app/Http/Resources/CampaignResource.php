<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\User;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * This is Campaign Resource
 *
 * Class CampaignResource
 * @package App\Http\Resources
 */

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Campaign"
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
 *      property="project",
 *      type="object",
 *      description="Проект, которому принадлежит кампания",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/ProjectResource")
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="string",
 *      description="Имя кампании",
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
 *      property="date_from",
 *      type="string",
 *      description="Время начала кампании",
 *      default="available",
 *      format="date-time"
 *   ),
 *   @SWG\Property(
 *      property="date_to",
 *      type="string",
 *      description="Время окончания кампании",
 *      default="available",
 *      format="date-time"
 *   ),
 *   @SWG\Property(
 *      property="status_global",
 *      type="string",
 *      description="Статус глобальный",
 *      enum={"0 - включена","1 - выключена","2 - требуется настройка","3 - требуется бюджет"},
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="status_moderation",
 *      type="string",
 *      description="Статус модерации объявлений",
 *      enum={"0 - OK","1 - на модерации","2 - отклонён","3 - изменён на модерации, требуется подтверждение"},
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="daily_budget",
 *      type="integer",
 *      description="Дневной бюджет",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="budget",
 *      type="integer",
 *      description="Общий бюджет",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="comment",
 *      type="string",
 *      description="Комментарий",
 *      default="available"
 *   )
 * )
 */

class CampaignResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => $this->user,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'status_global' => $this->status_global,
            'status_moderation' => $this->status_moderation,
            'daily_budget' => $this->daily_budget,
            'budget' => $this->budget,
            'comment' => $this->comment,
            'project' => $this->project
        ];
    }
}
