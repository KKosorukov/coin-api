<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Backoffice\Adv;
use App\Models\Backoffice\Banner;


/**
 * This is Advertise Resource
 *
 * Class AdvTypeResource
 * @package App\Http\Resources
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Advertise"
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
 *      description="Название объявления (как в админке)",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="is_dummy",
 *      type="boolean",
 *      description="Заглушка или нет",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="adv_type",
 *      type="object",
 *      description="Тип объявления",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/AdvTypeResource")
 *   ),
 *   @SWG\Property(
 *      property="banners",
 *      type="array",
 *      description="Коллекция баннеров объявления",
 *      default="available",
 *      @SWG\Items(
 *          type="object",
 *          @SWG\Schema(ref="#/definitions/BannerResource")
 *      ),
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
 *      property="comment",
 *      type="string",
 *      description="Комментарий",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="picture",
 *      type="string",
 *      description="Base64-картинка для объявления",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="status_global",
 *      type="string",
 *      description="Статус глобальный",
 *      enum={"0 - включено","1 - выключено", "2 - требуется бюджет"},
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="status_moderation",
 *      type="string",
 *      description="Статус модерации",
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
 *      property="num_shows",
 *      type="integer",
 *      description="Количество показов",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="num_clicks",
 *      type="integer",
 *      description="Количество кликов",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="url",
 *      type="string",
 *      description="URL объявления",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="title",
 *      type="string",
 *      description="Заголовок объявления",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="text",
 *      type="string",
 *      description="Текст объявления",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="moderator_comment",
 *      type="string",
 *      description="Модераторский комментарий",
 *      default="available",
 *   ),
 *   @SWG\Property(
 *      property="sets",
 *      type="string",
 *      description="
 *          Возможные типы объявлений:
 *          1. Popup:
 *          {
 *              alias : 'adv-popup',
 *              banner_form_id : null,
 *              banner_type_id : null,
 *              container_form_id : 2,
 *              container_type_id : null,
 *          }
 *          2. Static banner:
 *          {
 *              alias : 'adv-static',
 *              banner_form_id : null,
 *              banner_type_id : null,
 *              container_form_id : 1,
 *              container_type_id : null
 *          }
 *          3. Dinamic banner:
 *          {
 *              alias : 'adv-dynamic',
 *              banner_form_id : null,
 *              banner_type_id : null,
 *              container_form_id : null,
 *              container_type_id : null
 *          }
 *          4. Text banner:
 *          {
 *              alias : 'adv-text',
 *              banner_form_id : null,
 *              banner_type_id : null,
 *              container_form_id : null,
 *              container_type_id : null
 *          }
 *          5. Carousel:
 *          {
 *              alias : 'adv-carousel',
 *              banner_form_id : 2,
 *              banner_type_id : null,
 *              container_form_id : null,
 *              container_type_id : null
 *          }
 *          6. LinkContext:
 *          {
 *              alias : 'adv-linkcontext'
 *              banner_form_id : null,
 *              banner_type_id : null,
 *              container_form_id : null,
 *              container_type_id : null
 *          }
 *       ",
 *   )
 * )
 */


class AdvResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_dummy' => $this->is_dummy,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'adv_type' => $this->advType,
            'banners' => $this->getBanners(),
            'comment' => $this->comment,
            'picture' => $this->picture,
            'status_global' => $this->status_global,
            'status_moderation' => $this->status_moderation,
            'num_shows' => $this->num_shows,
            'num_clicks' => $this->num_clicks,
            'url' => $this->url,
            'title' => $this->title,
            'text' => $this->text,
            'moderator_comment' => $this->moderator_comment,
            'daily_budget' => $this->daily_budget,
            'sets' => $this->sets
        ];
    }
}
