<?php

/**
 * @SWG\Get(
 *     path="/api/v1/campaign",
 *     description="Возвращает коллекцию кампаний для пользователя",
 *     operationId="getCampaigns",
 *     produces={"application/json"},
 *     tags={"campaign"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по кампаниям",
 *         @SWG\Schema(
 *              type="array",
 *              @SWG\Items(ref="#/definitions/CampaignResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/campaign', 'API\Campaign\CampaignController@getAllCampaigns');


/**
 * @SWG\Get(
 *     path="/api/v1/campaign/{campaign}",
 *     description="Возвращает кампанию по её идентификатору",
 *     operationId="getСampaign",
 *     produces={"application/json"},
 *     tags={"campaign"},
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
 *         description="JSON с данными по кампании",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/CampaignResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/v1/campaign/{campaign}', 'API\Campaign\CampaignController@getCampaign');

/**
 * @SWG\Post(
 *     path="/api/v1/campaign/{campaign}/update",
 *     description="Апдейтит информацию по кампании",
 *     operationId="updateСampaign",
 *     produces={"application/json"},
 *     tags={"campaign"},
 *     @SWG\Parameter(
 *       name="campaign",
 *       in="path",
 *       type="integer",
 *       description="ID кампании",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название кампании",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="date_from",
 *       in="query",
 *       type="string",
 *       description="Дата начала кампании (в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="date_to",
 *       in="query",
 *       type="string",
 *       description="Дата окончания кампании (в формате ГГГГ-ММ-ДД ЧЧ:ММ:CC)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="status_global",
 *       in="query",
 *       type="string",
 *       description="Глобальный статус",
 *       enum={"0 - включена","1 - выключена","2 - требуется настройка","3 - требуется бюджет"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="status_moderation",
 *       in="query",
 *       type="string",
 *       description="Статус модерации объявлений",
 *       enum={"0 - OK","1 - на модерации","2 - отклонён","3 - изменён на модерации, требуется подтверждение"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="comment",
 *       in="query",
 *       type="string",
 *       description="Комментарий",
 *       default="available"
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Дневной бюджет кампании",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет кампании суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="project_id",
 *       in="query",
 *       type="integer",
 *       description="Проект, которому принадлежит данная кампания",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по кампании",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/CampaignResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/campaign/{campaign}/update', 'API\Campaign\CampaignController@updateCampaign');

/**
 * @SWG\Post(
 *     path="/api/v1/campaign/{campaign}/delete",
 *     description="Удаляет кампанию",
 *     operationId="updateСampaign",
 *     produces={"application/json"},
 *     tags={"campaign"},
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
 *         description="JSON с данными по кампании",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/CampaignResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/campaign/{campaign}/delete', 'API\Campaign\CampaignController@deleteCampaign');


/**
 * @SWG\Post(
 *     path="/api/v1/campaign/create",
 *     description="Создаёт кампанию",
 *     operationId="createСampaign",
 *     produces={"application/json"},
 *     tags={"campaign"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название кампании. До 255 символов.",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="date_from",
 *       in="query",
 *       type="string",
 *       description="Дата начала кампании (в формате ГГГГ-ММ-ДД ЧЧ:ММ:СС)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="date_to",
 *       in="query",
 *       type="string",
 *       description="Дата окончания кампании (в формате ГГГГ-ММ-ДД ЧЧ:ММ:CC)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Дневной бюджет кампании",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет кампании суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="project_id",
 *       in="query",
 *       type="integer",
 *       description="Проект, которому принадлежит данная кампания",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по кампании",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/CampaignResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::post('/v1/campaign/create', 'API\Campaign\CampaignController@createCampaign');

/**
 * @SWG\Get(
 *     path="/api/v1/advgroup",
 *     description="Возвращает коллекцию групп объявлений для пользователя",
 *     operationId="getAdvGroups",
 *     produces={"application/json"},
 *     tags={"advgroup"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по группам объявлений",
 *         @SWG\Schema(
 *              type="object",
 *              @SWG\Items(ref="#/definitions/AdvGroupResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */