<?php

Route::get('/v1/advgroup', 'API\Adv\AdvGroupController@getAllAdvGroups');


/**
 * @SWG\Get(
 *     path="/api/v1/advgroup/{advgroup}",
 *     description="Возвращает группу объявлений по её идентификатору",
 *     operationId="getAdvGroup",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Parameter(
 *       name="advgroup",
 *       in="path",
 *       type="integer",
 *       description="ID группы объявлений",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по группам объявлений",
 *         @SWG\Schema(
 *            type="array",
 *            @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/advgroup/{advgroup}', 'API\Adv\AdvGroupController@getAdvGroup');


/**
 * @SWG\Get(
 *     path="/v1/advgroup/campaign/{campaign}",
 *     description="Возвращает список групп объявлений по ID кампании",
 *     operationId="getAdvGroupsByCampaignId",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Parameter(
 *       name="campaign",
 *       in="path",
 *       type="integer",
 *       description="ID кампании",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по кампаниям",
 *         @SWG\Schema(
 *            type="array",
 *            @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/advgroup/campaign/{campaign}', 'API\Adv\AdvGroupController@getAdvGroupsByCampaignId');


/**
 * @SWG\Post(
 *     path="/api/v1/advgroup/{advgroup}/update",
 *     description="Апдейтит информацию по группе рекламных объявлений",
 *     operationId="updateAdvGroup",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Parameter(
 *       name="advgroup",
 *       in="path",
 *       type="integer",
 *       description="ID группы рекламных объявлений",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название группы рекламных объявлений",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Дневной бюджет группы",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет группы суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="click_price",
 *       in="query",
 *       type="integer",
 *       description="Цена за клик",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по кампании",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/advgroup/{advgroup}/update', 'API\Adv\AdvGroupController@updateAdvGroup');

/**
 * @SWG\Post(
 *     path="/api/v1/advgroup/{advgroup}/delete",
 *     description="Удаляет группу рекламных объявлений",
 *     operationId="deleteAdvGroup",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Parameter(
 *       name="advgroup",
 *       in="path",
 *       type="integer",
 *       description="ID группы рекламных объявлений",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по удалённой группе",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/advgroup/{advgroup}/delete', 'API\Adv\AdvGroupController@deleteAdvGroup');


/**
 * @SWG\Post(
 *     path="/api/v1/advgroup/create",
 *     description="Создаёт группу рекламных объявлений",
 *     operationId="createAdvGroup",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название группы. До 255 символов.",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="campaign",
 *       in="query",
 *       type="integer",
 *       description="ID кампании, к которой привязана группа",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Дневной бюджет группы",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет группы суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="click_price",
 *       in="query",
 *       type="integer",
 *       description="Цена за клик",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="segments",
 *       in="query",
 *       type="integer",
 *       description="Массив ( [1,2...] ) с идентификаторами сегментов, которые надо прикрепить к свежесозданной группе",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданной группе",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/advgroup/create', 'API\Adv\AdvGroupController@createAdvGroup');