<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

/**
 * This is User Resource
 *
 * Class UserResource
 * @package App\Http\Resources
 */


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
 *   @SWG\Property(
 *      property="timezone",
 *      type="string",
 *      description="Часовой пояс",
 *   ),
 * )
 */

class UserResource extends JsonResource
{
    /**
     * @var int
     */
    // protected $id; @TODO Fields are not extend...?

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
            'last_login' => $this->last_login,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'skype_id' => (string) $this->skype_id,
            'telegram_id' => (string) $this->telegram_id,
            'email' => (string) $this->email,
            'bill' => $this->bill,
            'roles' => $this->roles,
            'api_key' => $this->api_key,
            'timezone' => $this->timezone,
            'avatar' => $this->avatar,
            'matomo' => $this->matomo,
            'project_id' => Project::where('user_id', $this->id)->first()['id']
        ];
    }
}
