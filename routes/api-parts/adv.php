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
 *     path="/api/v1/user/{user}/adv/{from?}/{to?}",
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
 *     @SWG\Parameter(
 *       name="from",
 *       in="path",
 *       type="string",
 *       description="Дата начала для фильтра вывода (формат YYYY-MM-DD)",
 *     ),
 *     @SWG\Parameter(
 *       name="to",
 *       in="path",
 *       type="string",
 *       description="Дата конца для фильтра вывода (формат YYYY-MM-DD)",
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

Route::get('/v1/user/{user}/adv/{from?}/{to?}', 'API\Adv\AdvController@getAllAdvs');


/**
 * @SWG\Get(
 *     path="/v1/adv/advgroup/{advgroup}",
 *     description="Возвращает все объявления для конкретного юзера для конкретной группы",
 *     operationId="listOfAdvsInAdvGroup",
 *     produces={"application/json"},
 *     tags={"user", "adv"},
 *      @SWG\Parameter(
 *         name="advgroup",
 *         in="path",
 *         description="ID группы, для которой хотим получить список",
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

Route::get('/v1/adv/advgroup/{advgroup}', 'API\Adv\AdvController@getAllAdvsByGroupId');


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
 *       name="adv_group_id",
 *       type="integer",
 *       in="query",
 *       description="ID группы объявлений",
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
 *       name="title",
 *       type="string",
 *       in="query",
 *       description="Заголовок объявления",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="long_description",
 *       type="string",
 *       in="query",
 *       description="Длинный текст объявления"
 *     ),
 *      @SWG\Parameter(
 *       name="short_description",
 *       type="string",
 *       in="query",
 *       description="Короткий текст объявления"
 *     ),
 *     @SWG\Parameter(
 *       name="moderator_comment",
 *       type="string",
 *       in="query",
 *       description="Модераторский комментарий",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_1",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 1",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_1",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 1",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_2",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 2",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_2",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 2",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_3",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 3",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_3",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 3",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_4",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 4",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_4",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 4",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="sets",
 *       type="string",
 *       in="query",
 *       description="
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
 *       name="adv_group_id",
 *       type="integer",
 *       in="query",
 *       description="ID группы объявлений",
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
 *       name="title",
 *       type="string",
 *       in="query",
 *       description="Заголовок объявления",
 *       default="available"
 *     ),
 *    @SWG\Parameter(
 *       name="long_description",
 *       type="string",
 *       in="query",
 *       description="Длинный текст объявления"
 *     ),
 *     @SWG\Parameter(
 *       name="short_description",
 *       type="string",
 *       in="query",
 *       description="Короткий текст объявления"
 *     ),
 *     @SWG\Parameter(
 *       name="moderator_comment",
 *       type="string",
 *       in="query",
 *       description="Модераторский комментарий",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_1",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 1",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_1",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 1",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_2",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 2",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_2",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 2",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_3",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 3",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_3",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 3",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_4",
 *       type="string",
 *       in="query",
 *       description="Дополнительный URL для объявления 4",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="additional_adv_url_desc_4",
 *       type="string",
 *       in="query",
 *       description="Описание для дополнительного URLа для объявления 4",
 *       default="available"
 *     ),
 *     *     @SWG\Parameter(
 *       name="sets",
 *       type="string",
 *       in="query",
 *       description="
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



/**
 * @SWG\Post(
 *     path="/api/v1/adv/preview",
 *     description="Возвращает превью объявления по параметрам контейнера",
 *     operationId="getAdvPreview",
 *     produces={"application/json"},
 *     tags={"adv"},
 *     @SWG\Parameter(
 *       name="container_type",
 *       in="query",
 *       type="integer",
 *       description="ID типа контейнера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="container_form",
 *       in="query",
 *       type="integer",
 *       description="ID формы контейнера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="banner_type",
 *       in="query",
 *       type="integer",
 *       description="ID типа баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="banner_form",
 *       in="query",
 *       type="integer",
 *       description="ID формы баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Превью в виде кода страницы, которую необходимо запустить на исполнение (например, в iframe)",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::post('/v1/adv/preview', 'API\Adv\AdvController@getPreview');

/**
 * @SWG\Get(
 *     path="/api/v1/adv/types",
 *     description="Возвращает все возможные типы объявлений",
 *     operationId="advTypes",
 *     produces={"application/json"},
 *     tags={"adv"},
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
Route::get('/v1/adv/types', 'API\Adv\AdvTypeController@getAllAdvTypes');


Route::post('/v1/adv/clear', 'API\Adv\AdvTypeController@clear');


/**
 * @SWG\Get(
 *   path="/api/v1/webmaster/list",
 *   description="Получить список вебмастеров.",
 *   operationId="webmasterList",
 *   produces={"application/json"},
 *   tags={"webmaster", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="",
 *      @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/WebmasterResource")
 *      )
 *   ),
 *   @SWG\Response(
 *      response=404,
 *      description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *      response=403,
 *      description="Доступ запрещён",
 *   )
 * )
 */
Route::get('/v1/adv/list-grouped-by-advertisers', 'API\Adv\AdvController@getAdvGroupListGroupedByAdvertisers');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/allow",
 *   description="Одобрить все сайты вебмастера.",
 *   operationId="webmasterList",
 *   produces={"application/json"},
 *   tags={"webmaster", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="",
 *      @SWG\Schema(
 *         type="json",
 *      )
 *   ),
 *   @SWG\Response(
 *      response=404,
 *      description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *      response=403,
 *      description="Доступ запрещён",
 *   )
 * )
 */
Route::post('/v1/adv/allow', 'API\Adv\AdvController@allow');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/reject",
 *   description="Отказать всем сайтам вебмастера.",
 *   operationId="webmasterList",
 *   produces={"application/json"},
 *   tags={"webmaster", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="",
 *      @SWG\Schema(
 *         type="json",
 *      )
 *   ),
 *   @SWG\Response(
 *      response=404,
 *      description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *      response=403,
 *      description="Доступ запрещён",
 *   )
 * )
 */
Route::post('/v1/adv/reject', 'API\Adv\AdvController@reject');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/block",
 *   description="Заблокировать все сайты вебмастера.",
 *   operationId="webmasterList",
 *   produces={"application/json"},
 *   tags={"webmaster", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="",
 *      @SWG\Schema(
 *         type="json",
 *      )
 *   ),
 *   @SWG\Response(
 *      response=404,
 *      description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *      response=403,
 *      description="Доступ запрещён",
 *   )
 * )
 */
Route::post('/v1/adv/block', 'API\Adv\AdvController@block');
