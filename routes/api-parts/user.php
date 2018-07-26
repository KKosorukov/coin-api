<?php

/**
 * @SWG\Post(
 *   path="/api/v1/user/register",
 *   description="Регистрация. Для корректной работы метода требуется указывать заголовок Accept: application/json",
 *   operationId="userCreate",
 *   produces={"application/json"},
 *   tags={"user"},
 *   @SWG\Parameter(
 *      name="first_name",
 *      in="query",
 *      type="string",
 *      description="Имя. Максимально 50 символов.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="last_name",
 *      in="query",
 *      type="string",
 *      description="Фамилия. Максимально 50 символов.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="skype_id",
 *      in="query",
 *      type="string",
 *      description="Skype ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Parameter(
 *      name="telegram_id",
 *      in="query",
 *      type="string",
 *      description="Telegram ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *   ),
 *   @SWG\Parameter(
 *      name="email",
 *      in="query",
 *      type="string",
 *      description="Email. Максимально 50 символов.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="password",
 *      in="query",
 *      type="string",
 *      description="Пароль. 30 символов максимум.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="password_repeat",
 *      in="query",
 *      type="string",
 *      description="Повтор пароля",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="secret_question_id",
 *      in="query",
 *      type="string",
 *      description="ID секретного вопроса",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="secret_question_answer",
 *      in="query",
 *      type="string",
 *      description="Ответ на секретный вопрос. От 5 до 255 символов.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="role",
 *      in="query",
 *      type="integer",
 *      description="Роль пользователя. Может принимать значения, определённые методом /api/v1/role.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Response(
 *      response=200,
 *      description="Успешно завершена регистрация, требуется активация",
 *      @SWG\Schema(
 *         type="object",
 *         @SWG\Items(ref="#/definitions/UserResource")
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

Route::post('/v1/user/register', 'API\User\AccountController@createAccount');

/**
 * @SWG\Post(
 *     path="/api/v1/user/activate",
 *     description="Активация",
 *     operationId="userActivation",
 *     produces={"application/json"},
 *     tags={"user"},
 *     @SWG\Parameter(
 *         name="token",
 *         in="query",
 *         description="Токен активации",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         name="user",
 *         in="query",
 *         description="ID пользователя",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешная активация",
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
Route::post('/v1/user/activate', 'API\User\AccountController@activateAccount');

/**
 * @SWG\Post(
 *     path="/api/v1/user/send-activation-email",
 *     description="Повторный посыл письма активации",
 *     operationId="userActivation",
 *     produces={"application/json"},
 *     tags={"user"},
 *     @SWG\Parameter(
 *         name="user",
 *         in="query",
 *         description="ID пользователя",
 *         required=true,
 *         type="integer"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Письмо успешно выслано",
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
Route::post('/v1/user/send-activation-email', 'API\User\AccountController@sendActivationEmailAgain');

/**
 * @SWG\Post(
 *     path="/api/v1/user/profile",
 *     description="Апдейт профиля",
 *     operationId="userUpdate",
 *     produces={"application/json"},
 *     tags={"user"},
 *     @SWG\Parameter(
 *      name="first_name",
 *      in="query",
 *      type="string",
 *      description="Имя. Максимально 50 символов.",
 *      default="available",
 *      required=true
 *     ),
 *     @SWG\Parameter(
 *      name="last_name",
 *      in="query",
 *      type="string",
 *      description="Фамилия. Максимально 50 символов.",
 *      default="available",
 *      required=true
 *     ),
 *     @SWG\Parameter(
 *      name="skype_id",
 *      in="query",
 *      type="string",
 *      description="Skype ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *     ),
 *     @SWG\Parameter(
 *      name="telegram_id",
 *      in="query",
 *      type="string",
 *      description="Telegram ID. Поле необязательное, может быть до 50 символов.",
 *      default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="Успешное обновление профиля",
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
Route::post('/v1/user/profile', 'API\User\AccountController@updateProfile');


/**
 * @SWG\Post(
 *    path="/api/v1/user/password/reset/1",
 *    description="Сброс пароля, шаг 1",
 *    operationId="userPasswordResetStepOne",
 *    produces={"application/json"},
 *    tags={"user"},
 *    @SWG\Parameter(
 *      name="email",
 *      in="query",
 *      type="string",
 *      description="Email пользователя, которому восстанавливаем пароль",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="secret_question_id",
 *      in="query",
 *      type="integer",
 *      description="ID секретного вопроса",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="secret_question_answer",
 *      in="query",
 *      type="string",
 *      description="Ответ на секретный вопрос",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Response(
 *      response=200,
 *      description="Успешный первый шаг сброса пароля, возвращается токен",
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
Route::post('/v1/user/password/reset/1', 'API\User\AccountController@resetPasswordStepOne');

/**
 * @SWG\Post(
 *   path="/api/v1/user/password/reset/2",
 *   description="Сброс пароля, шаг 2",
 *   operationId="userPasswordResetStepTwo",
 *   produces={"application/json"},
 *   tags={"user"},
 *   @SWG\Parameter(
 *      name="email",
 *      in="query",
 *      type="string",
 *      description="Email пользователя, которому восстанавливаем пароль",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="code",
 *      in="query",
 *      type="string",
 *      description="Код-токен, который был возвращён на первом шаге",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="password",
 *      in="query",
 *      type="string",
 *      description="Пароль. 30 символов максимум.",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Parameter(
 *      name="password_repeat",
 *      in="query",
 *      type="string",
 *      description="Повтор пароля",
 *      default="available",
 *      required=true
 *   ),
 *   @SWG\Response(
 *      response=200,
 *      description="Успешный второй шаг сброса пароля",
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
Route::post('/v1/user/password/reset/2', 'API\User\AccountController@resetPasswordStepTwo');