<?php

/**
 * @SWG\Get(
 *   path="/api/v1/manager/list",
 *   description="Получить список вебмастеров.",
 *   operationId="managerList",
 *   produces={"application/json"},
 *   tags={"manager", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="JSON в виде объекта с менеджером",
 *      @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/ManagerResource")
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

Route::get('/v1/manager/list', 'API\User\ManagerController@list');

/**
 * @SWG\Post(
 *   path="/api/v1/manager/allow",
 *   description="Одобрить указанные сайты.",
 *   operationId="managerList",
 *   produces={"application/json"},
 *   tags={"manager", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="JSON в виде массива объектов с менеджерами",
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

Route::post('/v1/manager/allow', 'API\User\ManagerController@allow');

/**
 * @SWG\Post(
 *   path="/api/v1/manager/reject",
 *   description="Отказать по указанным сайтам.",
 *   operationId="managerList",
 *   produces={"application/json"},
 *   tags={"manager", "admin"},
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

Route::post('/v1/manager/reject', 'API\User\ManagerController@reject');

/**
 * @SWG\Post(
 *   path="/api/v1/manager/block",
 *   description="Заблокировать указанные сайты.",
 *   operationId="managerList",
 *   produces={"application/json"},
 *   tags={"manager", "admin"},
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

Route::post('/v1/manager/block', 'API\User\ManagerController@block');

/**
 * @SWG\Get(
 *   path="/api/v1/manager/{id}",
 *   description="Получить одного вебмастера.",
 *   operationId="managerGet",
 *   produces={"application/json"},
 *   tags={"manager", "admin"},
 *   @SWG\Response(
 *      response=200,
 *      description="",
 *      @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/managerResource")
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

Route::get('/v1/manager/{id}', 'API\User\ManagerController@get');