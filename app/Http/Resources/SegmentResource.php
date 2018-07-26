<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * This is SegmentResource model
 *
 * Class Segment
 * @package App\Http\Models
 */


/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="SegmentModel"
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
 *      description="Название. Максимально 255 символов.",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="comment",
 *      type="string",
 *      description="Комментарий к сегменту",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="params",
 *      type="string",
 *      description="Параметры сегмента: раскрытый JSON",
 *      default="available"
 *   ),
 *   @SWG\Property(
 *      property="type",
 *      type="string",
 *      description="Тип сегмента",
 *      enum={"0 - включение","1 - исключение"},
 *      default="available"
 *   ),
 * )
 */

class SegmentResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request) + [
            'advgroups' => $this->advgroups
        ];
    }
}
