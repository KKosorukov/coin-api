<?php

namespace App\Models;

use App\Models\Backoffice\Adv;
use App\Models\Backoffice\Banner;
use App\Models\Backoffice\Bill;

use App\Models\Backoffice\Container;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * This is User Model
 *
 * Class User
 * @package App\Http\Models
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="UserModel"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="first_name",
 *      type="boolean",
 *      description="Имя. Максимально 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="last_name",
 *      type="string",
 *      description="Фамилия. Максимально 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="skype_id",
 *      type="string",
 *      description="Skype ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="telegram_id",
 *      type="string",
 *      description="Telegram ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="email",
 *      type="string",
 *      description="Email. Максимально 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="password",
 *      type="string",
 *      description="Пароль. 30 символов максимум.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="password_repeat",
 *      type="string",
 *      description="Повтор пароля",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="secret_question_id",
 *      type="string",
 *      description="ID секретного вопроса",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="secret_question_answer",
 *      type="string",
 *      description="Ответ на секретный вопрос. От 5 до 255 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="role",
 *      type="integer",
 *      description="Роль пользователя. Может принимать значения, определённые методом /api/v1/role.",
 *      default="available"
 *   ),
 * )
 */


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'skype_id', 'telegram_id', 'api_key', 'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'permissions', 'created_at', 'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get all advertisings for this user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adv() {
        return $this->hasMany(Adv::class);
    }

    /**
     * Has only one bill
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bill() {
        return $this->hasOne(Bill::class, 'user_id', 'id');
    }

    /**
     * Has many roles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany('App\Models\Backoffice\Role', 'role_users', 'role_id', 'user_id');
    }

    /**
     * Has access or not
     * @return int
     */
    public function hasAccess($rule) {
        foreach($this->roles as $role) {
            foreach($role->permissions as $permission => $value) {
                if($permission == $rule) {
                    return $value;
                }
            }
        }

        // Rule not found
        return false;
    }
}
