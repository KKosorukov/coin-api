<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Backoffice\Adv;

/**
 * This is Advertise Group Resource
 *
 * Class AdvTypeResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="AdvertiseGroup"
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
 *      description="Название группы объявлений",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="advs",
 *      type="array",
 *      description="Коллекция объявлений",
 *      default="available",
 *      @SWG\Items(
 *          type="object",
 *          @SWG\Schema(ref="#/definitions/AdvResource")
 *      ),
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
 *   ),
 *   @SWG\Property(
 *      property="click_price",
 *      type="numeric",
 *      description="Цена за клик",
 *      default="available",
 *      format="float"
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
 *      property="expenses",
 *      type="numeric",
 *      description="Затраты",
 *      format="float"
 *   ),
 *   @SWG\Property(
 *      property="scope",
 *      type="integer",
 *      description="Охват аудитории"
 *   ),
 *   @SWG\Property(
 *      property="views",
 *      type="integer",
 *      description="Показы за период"
 *   ),
 *   @SWG\Property(
 *      property="CTR",
 *      type="numeric",
 *      description="Коэффициент кликабельности",
 *      format="float"
 *   ),
 *   @SWG\Property(
 *      property="CPC",
 *      type="numeric",
 *      description="Цена за клик",
 *      format="float"
 *   ),
 *   @SWG\Property(
 *      property="clicks",
 *      type="numeric",
 *      description="Количество кликов",
 *      format="float"
 *   )
 * )
 */

class AdvGroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'advs' => $this->advs,
            'status' => $this->status,
            'segments' => $this->segments,
            'budget' => $this->budget,
            'daily_budget' => $this->daily_budget,
            'click_price' => $this->click_price,
            'expenses' => $this->expenses,
            'scope' => $this->scope,
            'views' => $this->num_shows,
            'ctr' => $this->ctr,
            'cpc' => $this->cpc,
            'clicks' => $this->num_clicks,
            'created_at' => $this->created_at
        ];
    }
}
