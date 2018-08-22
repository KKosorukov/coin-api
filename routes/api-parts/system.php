<?php

/**
 * @SWG\Get(
 *   path="/api/v1/system/user/{user}/code",
 *   description="Получить код для пользователя",
 *   operationId="codeGet",
 *   produces={"application/json"},
 *   tags={"user"},
 *   @SWG\Parameter(
 *       name="user",
 *       in="path",
 *       type="integer",
 *       description="ID пользователя",
 *       required=true
 *     ),
 *   @SWG\Response(
 *       response=200,
 *       description="Код-счётчик на сайт для пользователя",
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
Route::get('/v1/system/user/{user}/code', 'API\System\SystemController@getCodeByUserId');
