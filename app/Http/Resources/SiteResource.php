<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="User"
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
 *      description="Права доступа, поставленные на пользователя (не на группу, которой он принадлежит)",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="last_login",
 *      type="string",
 *      description="Время последнего входа",
 *      default="available",
 *      format="date-time"
 *   ),
 *    @SWG\Property(
 *      property="first_name",
 *      type="boolean",
 *      description="Имя",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="last_name",
 *      type="string",
 *      description="Фамилия",
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
 *      property="skype_id",
 *      type="string",
 *      description="Skype ID",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="telegram_id",
 *      type="string",
 *      description="Telegram ID",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="email",
 *      type="string",
 *      description="Email",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="bill",
 *      type="string",
 *      description="Характеристики по счёту в разных валютах",
 *      default="available",
 *      @SWG\Schema(ref="#/definitions/BillResource")
 *   ),
 *   @SWG\Property(
 *      property="roles",
 *      type="string",
 *      description="Роли пользователя",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="api_key",
 *      type="string",
 *      description="Ключ API",
 *      default="available"
 *   ),
 * )
 */

class SiteResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
