<?php

/**
 * @SWG\Get(
 *     path="/api/v1/banner",
 *     description="Возвращает коллекцию баннеров для пользователя",
 *     operationId="getBanners",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по баннерам",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/BannerResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/banner', 'API\Banner\BannerController@getAllBanners');

/**
 * @SWG\Get(
 *     path="/api/v1/banner/{banner}",
 *     description="Возвращает баннер по его идентификатору",
 *     operationId="getBanner",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="banner",
 *       in="path",
 *       type="integer",
 *       description="ID баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по баннеру",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/BannerResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/banner/{banner}', 'API\Banner\BannerController@getBanner');

/**
 * @SWG\Post(
 *     path="/api/v1/banner/{banner}/update",
 *     description="Апдейтит информацию по баннерам",
 *     operationId="updateBanner",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="title",
 *       in="query",
 *       type="string",
 *       description="Название баннера. До 255 символов.",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="description",
 *       in="query",
 *       type="string",
 *       description="Описание баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="path",
 *       in="query",
 *       type="string",
 *       description="Название файла (выдаётся методом, загружающим файл)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="adv_id",
 *       in="query",
 *       type="integer",
 *       description="ID объявления, в который будет помещён этот баннер. Изначально баннер может &quot;висеть в воздухе&quot; и не быть прикреплённым ни к кому",
 *       default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по баннеру",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/BannerResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/banner/{banner}/update', 'API\Banner\BannerController@updateBanner');

/**
 * @SWG\Post(
 *     path="/api/v1/banner/{banner}/delete",
 *     description="Удаляет баннер",
 *     operationId="updateBanner",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="banner",
 *       in="path",
 *       type="integer",
 *       description="ID баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по баннеру",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/BannerResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/banner/{banner}/delete', 'API\Banner\BannerController@deleteBanner');

/**
 * @SWG\Post(
 *     path="/api/v1/banner/create",
 *     description="Создаёт баннер",
 *     operationId="createBanner",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="title",
 *       in="query",
 *       type="string",
 *       description="Название баннера. До 255 символов.",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="description",
 *       in="query",
 *       type="string",
 *       description="Описание баннера",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="path",
 *       in="query",
 *       type="string",
 *       description="Название файла (выдаётся методом, загружающим файл)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="adv_id",
 *       in="query",
 *       type="integer",
 *       description="ID объявления, в который будет помещён этот баннер. Изначально баннер может &quot;висеть в воздухе&quot; и не быть прикреплённым ни к кому",
 *       default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по баннеру",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/BannerResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/banner/create', 'API\Banner\BannerController@createBanner');


/**
 * @SWG\Post(
 *     path="/api/v1/banner/upload",
 *     description="Загружает баннер",
 *     operationId="uploadBanner",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="cont_type",
 *       in="query",
 *       type="string",
 *       description="Тип контейнера: горизонтальный (horizontal) или вертикальный (vertical)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="cont_form",
 *       in="query",
 *       type="string",
 *       description="Форма контейнера: попап (popup) или инлайн (inline)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="banner",
 *       in="query",
 *       type="string",
 *       description="Загружаемый файл баннера (в base64-формате)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по загруженному файлу баннера",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */



Route::post('/v1/banner/upload', 'API\Banner\BannerController@uploadBanner');


/**
 * @SWG\Post(
 *     path="/api/v1/banner/delete-from-filesystem",
 *     description="Удаляет баннер из файловой системы. Например, такое может использоваться, чтобы удалить загруженный баннер для несозданного объявления",
 *     operationId="deleteBannerFromFileSystem",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *       name="path",
 *       in="query",
 *       type="string",
 *       description="Название файла (с расширением), которое удаляем",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Состояние удаления: успешно или нет",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */



Route::post('/v1/banner/delete-from-filesystem', 'API\Banner\BannerController@deleteUncreated');



/**
 * @SWG\Get(
 *     path="/api/v1/banner/random",
 *     description="Возвращает рандомный баннер по токену",
 *     operationId="randomBannerItem",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Изображение баннера",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/banner/random', 'API\Banner\BannerController@getRandom');