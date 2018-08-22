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
 *   path="/api/v1/manager/{id}/allow",
 *   description="Одобрить все сайты вебмастера.",
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

Route::post('/v1/manager/{id}/allow', 'API\User\ManagerController@allow');

/**
 * @SWG\Post(
 *   path="/api/v1/manager/{id}/reject",
 *   description="Отказать всем сайтам вебмастера.",
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

Route::post('/v1/manager/{id}/reject', 'API\User\ManagerController@reject');

/**
 * @SWG\Post(
 *   path="/api/v1/manager/{id}/block",
 *   description="Заблокировать все сайты вебмастера.",
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

Route::post('/v1/manager/{id}/block', 'API\User\ManagerController@block');

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