<?php

namespace App\Http\Resources;

use App\Models\Backoffice\Language;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(
 *     name="Language"
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
 *      description="Системное название языка"
 *   ),
 *    @SWG\Property(
 *      property="displays",
 *      type="string",
 *      description="Отображаемое название языка"
 *   )
 * )
 */

class LanguageResource extends UserResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'displayed' => $this->displays
        ];
    }
}