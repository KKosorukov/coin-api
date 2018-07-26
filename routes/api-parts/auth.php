<?php


Route::group([
    'middleware' => 'api',
    'prefix' => '/v1/auth'
], function($router) {

    /**
     * @SWG\Post(
     *     path="/api/v1/auth/login",
     *     description="Аутентифицирует пользователя по логину и паролю. Тестовые логины - manager@testmail.com, webmaster@testmail.com, administrator@testmail.com. Пароль у всех - 123456. В дальнейшем, авторизованные запросы требуют заголовка Authorization: Bearer [token]",
     *     operationId="authLogin",
     *     produces={"application/json"},
     *     tags={"auth"},
     *     @SWG\Parameter(
     *         name="login",
     *         in="query",
     *         description="Логин",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="query",
     *         description="Пароль",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Токен и его сопутствующие",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Ресурс не найден",
     *     ),
     *      @SWG\Response(
     *         response=403,
     *         description="Данные логин и пароль не найдены",
     *     )
     * )
     */

    Route::post('login', 'API\User\AuthController@login');

    /**
     * @SWG\Post(
     *     path="/api/v1/auth/logout",
     *     description="Выход пользователя из сессии",
     *     operationId="authLogout",
     *     produces={"application/json"},
     *     tags={"auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="Всё ок, разлогинились",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Ресурс не найден",
     *     )
     * )
     */

    Route::post('logout', 'API\User\AuthController@logout');

    /**
     * @SWG\Post(
     *     path="/api/v1/auth/refresh",
     *     description="Обновить токен",
     *     operationId="authRefresh",
     *     produces={"application/json"},
     *     tags={"auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="Токен и его сопутствующие",
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

    Route::post('refresh', 'API\User\AuthController@refresh');

    /**
     * @SWG\Get(
     *     path="/api/v1/auth/me",
     *     description="Получить аутентифицированного юзера",
     *     operationId="authMe",
     *     produces={"application/json"},
     *     tags={"auth"},
     *     @SWG\Response(
     *         response=200,
     *         description="Пользователь, который успешно аутентифицирован",
     *         @SWG\Schema(
     *              type="object",
     *              @SWG\Items(ref="#/definitions/UserResource")
     *         )
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

    Route::get('me', 'API\User\AuthController@me');
});