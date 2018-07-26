<?php


/**
 * @SWG\Get(
 *   path="/api/v1/secretquestion",
 *   description="Получить список вариантов для секретных вопросов",
 *   operationId="secretQuestionsGet",
 *   produces={"application/json"},
 *   tags={"user"},
 *   @SWG\Response(
 *       response=200,
 *       description="Успешно выбраны все доступные варианты секретных вопросов",
 *       @SWG\Schema(
 *           type="object",
 *           @SWG\Items(ref="#/definitions/SecretQuestionResource")
 *       )
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

Route::get('/v1/secretquestion', 'API\User\AccountController@getSecretQuestions');