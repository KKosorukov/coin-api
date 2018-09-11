<?php

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
