<?php

/**
 * @SWG\Post(
 *     path="/api/v1/project/create",
 *     description="Создает проект для текущего пользователя",
 *     operationId="createProject",
 *     produces={"application/json"},
 *     tags={"project", "create"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название проекта",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет проекта суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет проекта суточный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="status",
 *       in="query",
 *       type="integer",
 *       description="Статус проекта",
 *       enum={"0 - включен","1 - выключен"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданному проекту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/ProjectResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/project/create', 'API\Project\ProjectController@createProject');

/**
 * @SWG\Post(
 *     path="/api/v1/project/{project}/update",
 *     description="Изменяет проект с указанным Id для текущего пользователя",
 *     operationId="updateProject",
 *     produces={"application/json"},
 *     tags={"project", "update"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название проекта",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет проекта суммарный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="daily_budget",
 *       in="query",
 *       type="integer",
 *       description="Бюджет проекта суточный",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="status",
 *       in="query",
 *       type="integer",
 *       description="Статус проекта",
 *       enum={"0 - включен","1 - выключен"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по отредактированному проекту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/ProjectResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/project/{project}/update', 'API\Project\ProjectController@updateProject');


/**
 * @SWG\Post(
 *     path="/api/v1/{project}/delete",
 *     description="Удаляет проект",
 *     operationId="deleteProject",
 *     produces={"application/json"},
 *     tags={"project", "delete"},
 *     @SWG\Response(
 *         response=200,
 *         description="status ok"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::post('/v1/project/{project}/delete', 'API\Project\ProjectController@deleteProject');

/**
 * @SWG\Get(
 *     path="/api/v1/project/list",
 *     description="Возвращает список проектов для текущего юзера.",
 *     operationId="listProject",
 *     produces={"application/json"},
 *     tags={"project", "list"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по проектам",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/ProjectResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 *
 *
 * )
 */
Route::get('/v1/project/list', 'API\Project\ProjectController@getAllProjects');