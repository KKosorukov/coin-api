<?php

/**
 * @SWG\Post(
 *     path="/api/v1/container/create",
 *     description="Создание пользовательского контейнера с баннерами",
 *     operationId="containerCreate",
 *     produces={"application/json"},
 *     tags={"container"},
 *     @SWG\Parameter(
 *         name="width",
 *         in="query",
 *         description="Ширина контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="height",
 *         in="query",
 *         description="Высота контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="type_id",
 *         in="query",
 *         description="Тип контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="num_banners",
 *         in="query",
 *         description="Количество баннеров в контейнере. От 1ого до 3х",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="displayed",
 *         in="query",
 *         description="Отображаемое наименование в таблице контейнеров",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешное создание контейнера с параматерами",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     ),
 *     @SWG\Response(
 *         response=403,
 *         description="Доступ запрещён",
 *     )
 * )
 */
Route::post('/v1/container/create', 'API\Banner\ContainerController@createContainerProUser');

/**
 * @SWG\Post(
 *     path="/api/v1/container/{container}/update",
 *     description="Обновление пользовательского контейнера с баннерами",
 *     operationId="containerUpdate",
 *     produces={"application/json"},
 *     tags={"container"},
 *     @SWG\Parameter(
 *         name="container",
 *         in="path",
 *         description="ID контейнера, который хотим обновить",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="width",
 *         in="query",
 *         description="Ширина контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="height",
 *         in="query",
 *         description="Высота контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="type_id",
 *         in="query",
 *         description="Тип контейнера",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="num_banners",
 *         in="query",
 *         description="Количество баннеров в контейнере. От 1ого до 3х",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Parameter(
 *         name="displayed",
 *         in="query",
 *         description="Отображаемое наименование в таблице контейнеров",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешное обновление пользовательского контейнера с баннерами",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     ),
 *     @SWG\Response(
 *         response=403,
 *         description="Доступ запрещён",
 *     )
 * )
 */
Route::post('/v1/container/{container}/update', 'API\Banner\ContainerController@editContainerProUser');

/**
 * @SWG\Post(
 *     path="/api/v1/container/{container}/delete",
 *     description="Удаление пользовательского контейнера с баннерами",
 *     operationId="containerDelete",
 *     produces={"application/json"},
 *     tags={"container"},
 *     @SWG\Parameter(
 *         name="container",
 *         in="path",
 *         description="ID контейнера, который хотим удалить",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешное удаление пользовательского контейнера с баннерами",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     ),
 *     @SWG\Response(
 *         response=403,
 *         description="Доступ запрещён",
 *     )
 * )
 */
Route::post('/v1/container/{container}/delete', 'API\Banner\ContainerController@deleteContainerProUser');

/**
 * @SWG\Post(
 *     path="/api/v1/container/{container}",
 *     description="Получение пользовательского контейнера с баннерами",
 *     operationId="containerGet",
 *     produces={"application/json"},
 *     tags={"container"},
 *     @SWG\Parameter(
 *         name="container",
 *         in="path",
 *         description="ID контейнера, который хотим получить",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешное получение пользовательского контейнера с баннерами",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     ),
 *     @SWG\Response(
 *         response=403,
 *         description="Доступ запрещён",
 *     )
 * )
 */
Route::post('/v1/container/{container}', 'API\Banner\ContainerController@getContainerProUser');


/**
 * @SWG\Get(
 *   path="/api/v1/container/type",
 *   description="Получить список типов контейнеров",
 *   operationId="containerTypeGet",
 *   produces={"application/json"},
 *   tags={"container"},
 *   @SWG\Response(
 *       response=200,
 *       description="Успешно выбраны все доступные типы контейнеров",
 *       @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/ContainerTypeResource")
 *      )
 *   ),
 *   @SWG\Response(
 *       response=404,
 *       description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *       response=403,
 *       description="Доступ запрещён",
 *   )
 * )
 */
Route::get('/v1/container/type', 'API\Banner\ContainerController@getContainerTypes');

/**
 * @SWG\Get(
 *   path="/api/v1/container",
 *   description="Получить список типов контейнеров аутентифицированного пользователя",
 *   operationId="containerGet",
 *   produces={"application/json"},
 *   tags={"container"},
 *   @SWG\Response(
 *       response=200,
 *       description="Успешно выбраны все доступные контейнеры для пользователя",
 *       @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/ContainerResource")
 *      )
 *   ),
 *   @SWG\Response(
 *       response=404,
 *       description="Ресурс не найден",
 *   ),
 *   @SWG\Response(
 *       response=403,
 *       description="Доступ запрещён",
 *   )
 * )
 */
Route::get('/v1/container', 'API\Banner\ContainerController@getContainers');