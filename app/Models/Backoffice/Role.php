<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

/**
 * This is Role Model
 *
 * Class Role
 * @package App\Http\Models
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="RoleModel"
 *   ),
 *   @SWG\Property(
 *      property="id",
 *      type="integer",
 *      description="Первичный ключ",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="slug",
 *      type="string",
 *      description="Символьный ключ. Максимально 255 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="name",
 *      type="string",
 *      description="Название роли. Максимально 255 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="is_default",
 *      type="boolean",
 *      description="Роль, создаваемая в системе по умолчанию нет?",
 *      default="available"
 *   ),
 * )
 */


class Role extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'is_default'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        $this->config = $attributes;
        parent::__construct($attributes);
    }

    /**
     * Get className
     */
    public static function who() {
        return __CLASS__;
    }

}
