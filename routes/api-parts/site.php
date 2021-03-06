<?php

/**
 * @SWG\Post(
 *     path="/api/v1/site/create",
 *     description="Создает сайт для текущего пользователя",
 *     operationId="createSite",
 *     produces={"application/json"},
 *     tags={"site"},
 *     @SWG\Parameter(
 *      name="url",
 *      in="query",
 *      type="string",
 *      description="URL сайта. До 255 символов.",
 *      default="site",
 *      required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданному сайту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SiteResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/site/create', 'API\Site\SiteController@create');

/**
 * @SWG\Post(
 *     path="/api/v1/site/{site}/update",
 *     description="Изменяет сайт с указанным Id для текущего пользователя",
 *     operationId="updateSite",
 *     produces={"application/json"},
 *     tags={"site", "admin"},
 *     @SWG\Parameter(
 *      name="is_text",
 *      in="query",
 *      type="boolean",
 *      description="Текстовая реклама.",
 *      default="site",
 *      required=true
 *     ),
 *     @SWG\Parameter(
 *      name="is_banner",
 *      in="query",
 *      type="boolean",
 *      description="Баннерная реклама.",
 *      default="site",
 *      required=true
 *     ),
 *     @SWG\Parameter(
 *      name="is_video",
 *      in="query",
 *      type="boolean",
 *      description="Видеореклама.",
 *      default="site",
 *      required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по отредактированному сайту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SiteResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/site/{site}/update', 'API\Site\SiteController@update');

/**
 * @SWG\Post(
 *     path="/api/v1/{site}/toggle",
 *     description="Меняет статус сайта с Active на Stopped (и наоборот). Не работает при других статусах.",
 *     operationId="toggleSite",
 *     produces={"application/json"},
 *     tags={"site"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданному сайту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SiteResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/site/{site}/toggle', 'API\Site\SiteController@toggle');

/**
 * @SWG\Post(
 *     path="/api/v1/{site}/delete",
 *     description="Удаляет сайт.",
 *     operationId="deleteSite",
 *     produces={"application/json"},
 *     tags={"site"},
 *     @SWG\Response(
 *         response=200,
 *         description="status ok"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/site/{site}/delete', 'API\Site\SiteController@delete');

/**
 * @SWG\Get(
 *     path="/api/v1/site/list",
 *     description="Возвращает список сайтов для текущего юзера.",
 *     operationId="listSite",
 *     produces={"application/json"},
 *     tags={"site"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданной группе",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SiteResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::get('/v1/site/list', 'API\Site\SiteController@list');

/**
 * @SWG\Post(
 *     path="/api/v1/site/check",
 *     description="Проверяет, доступен ли сайт в данный момент.",
 *     operationId="getSite",
 *     produces={"application/json"},
 *     tags={"site"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по сайтам",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SiteResource")
 *         )
 *     ),
 *     @SWG\Parameter(
 *      name="url",
 *      in="query",
 *      type="string",
 *      description="URL-адрес, начинающийся с http или https.",
 *      default="site",
 *      required=true
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */

Route::post('/v1/site/check', 'API\Site\SiteController@check');


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
Route::get('/v1/site/list-grouped-by-webmasters', 'API\Site\SiteController@getSiteListGroupedByWebmasters');

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
Route::post('/v1/site/allow', 'API\Site\SiteController@allow');

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
Route::post('/v1/site/reject', 'API\Site\SiteController@reject');

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
Route::post('/v1/site/block', 'API\Site\SiteController@block');
