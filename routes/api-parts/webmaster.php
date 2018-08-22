<?php

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

Route::get('/v1/webmaster/list', 'API\User\WebmasterController@list');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/{id}/allow",
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

Route::post('/v1/webmaster/{id}/allow', 'API\User\WebmasterController@allow');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/{id}/reject",
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

Route::post('/v1/webmaster/{id}/reject', 'API\User\WebmasterController@reject');

/**
 * @SWG\Post(
 *   path="/api/v1/webmaster/{id}/block",
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

Route::post('/v1/webmaster/{id}/block', 'API\User\WebmasterController@block');

/**
 * @SWG\Get(
 *   path="/api/v1/webmaster/{id}",
 *   description="Получить одного вебмастера.",
 *   operationId="webmasterGet",
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

Route::get('/v1/webmaster/{id}', 'API\User\WebmasterController@get');