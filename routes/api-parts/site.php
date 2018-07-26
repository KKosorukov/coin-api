<?php

/**
 * @SWG\Post(
 *     path="/api/v1/site/create",
 *     description="Создает сайт для текущего пользователя",
 *     operationId="createSite",
 *     produces={"application/json"},
 *     tags={"site", "create"},
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
 *     tags={"site", "update"},
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
 *     tags={"site", "toggle"},
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
 *     tags={"site", "delete"},
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
 *     tags={"site", "list"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по сайтам",
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