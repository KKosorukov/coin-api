<?php


Route::apiResource('advs', 'API\Adv\AdvController');
Route::apiResource('advtypes', 'API\AdvType\AdvController');

/**
 * @SWG\Get(
 *     path="/api/v1/user/{user}/adv/default",
 *     description="Возвращает дефолтное объявление для конкретного юзера",
 *     operationId="defaultAdv",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *     @SWG\Parameter(
 *         name="user",
 *         in="path",
 *         description="ID пользователя, для которого хотим получить объявление",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с объявлением",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/user/{user}/adv/default', 'API\Adv\AdvController@getDefaultAdv');

/**
 * @SWG\Get(
 *     path="/api/v1/user/{user}/adv",
 *     description="Возвращает все объявления для конкретного юзера",
 *     operationId="listOfAdvs",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *     @SWG\Parameter(
 *         name="user",
 *         in="path",
 *         description="ID пользователя, для которого хотим получить список",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON-коллекция объявлений",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/user/{user}/adv', 'API\Adv\AdvController@getAllAdvs');


/**
 * @SWG\Get(
 *     path="/api/v1/user/{user}/adv/{adv}",
 *     description="Возвращает конкретное объявление для конкретного юзера",
 *     operationId="advItem",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *     @SWG\Parameter(
 *         name="user",
 *         in="path",
 *         description="ID пользователя, для которого хотим получить список",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="adv",
 *         in="path",
 *         description="ID объявления, которое хотим вывести",
 *         required=true,
 *         type="integer",
 *         format="int"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON-коллекция объявлений",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/user/{user}/adv/{adv}', 'API\Adv\AdvController@getAdv');

/**
 * @SWG\Post(
 *     path="/api/v1/adv/create",
 *     description="Создаёт новое объявление",
 *     operationId="updateAdv",
 *     produces={"application/json"},
 *     tags={"adv"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название объявления (как в админке)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="is_dummy",
 *       in="query",
 *       type="boolean",
 *       description="Заглушка или нет. Допустимы значения true, false, 0 или 1",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="adv_type_id",
 *       type="integer",
 *       in="query",
 *       description="ID типа объявления",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="comment",
 *       type="string",
 *       in="query",
 *       description="Комментарий к объявлению",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="picture",
 *       type="string",
 *       in="query",
 *       description="Мини-картинка в base64, которая представляет объявление",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       type="integer",
 *       in="query",
 *       description="Дневной бюджет",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="url",
 *       type="string",
 *       in="query",
 *       description="URL объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="title",
 *       type="string",
 *       in="query",
 *       description="Заголовок объявления",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="text",
 *       type="string",
 *       in="query",
 *       description="Текст объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="moderator_comment",
 *       type="string",
 *       in="query",
 *       description="Модераторский комментарий",
 *       default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по объявлению",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/adv/create', 'API\Adv\AdvController@createAdv');


/**
 * @SWG\Post(
 *     path="/api/v1/user/{user}/adv/{adv}/update",
 *     description="Апдейтит информацию по объявлению",
 *     operationId="updateAdv",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *     @SWG\Parameter(
 *       name="user",
 *       in="path",
 *       description="ID пользователя, для которого хотим проапдейтить объявление",
 *       required=true,
 *       type="integer"
 *     ),
 *     @SWG\Parameter(
 *       name="adv",
 *       in="path",
 *       description="ID объявления, которое хотим проапдейтить",
 *       required=true,
 *       type="integer",
 *       format="int"
 *     ),
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название объявления (как в админке)",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="is_dummy",
 *       in="query",
 *       type="boolean",
 *       description="Заглушка или нет. Допустимы значения true, false, 0 или 1",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="adv_type_id",
 *       type="integer",
 *       in="query",
 *       description="ID типа объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="comment",
 *       type="string",
 *       in="query",
 *       description="Комментарий к объявлению",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="picture",
 *       type="string",
 *       in="query",
 *       description="Мини-картинка в base64, которая представляет объявление",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       type="integer",
 *       in="query",
 *       description="Дневной бюджет",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="url",
 *       type="string",
 *       in="query",
 *       description="URL объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="url",
 *       type="string",
 *       in="query",
 *       description="Заголовок объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="text",
 *       type="string",
 *       in="query",
 *       description="Текст объявления",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="text",
 *       type="string",
 *       in="query",
 *       description="Модераторский комментарий",
 *       default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по объявлению",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/user/{user}/adv/{adv}/update', 'API\Adv\AdvController@updateAdv');

/**
 * @SWG\Post(
 *     path="/api/v1/user/{user}/adv/{adv}/delete",
 *     description="Удаляет объявление",
 *     operationId="updateAdv",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *     @SWG\Parameter(
 *       name="user",
 *       in="path",
 *       description="ID пользователя, для которого хотим проапдейтить объявление",
 *       required=true,
 *       type="integer"
 *     ),
 *     @SWG\Parameter(
 *       name="adv",
 *       in="path",
 *       type="integer",
 *       description="ID объявления, которое хотим удалить",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по объявлению",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/user/{user}/adv/{adv}/delete', 'API\Adv\AdvController@deleteAdv');
