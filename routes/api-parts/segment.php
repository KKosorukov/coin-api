<?php

/**
 * @SWG\Post(
 *     path="/api/v1/segment/create",
 *     description="Создает сегмент для текущего пользователя",
 *     operationId="createSegment",
 *     produces={"application/json"},
 *     tags={"segment", "create"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название сегмента",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="comment",
 *       in="query",
 *       type="string",
 *       description="Комментарий",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="type",
 *       in="query",
 *       type="integer",
 *       description="Тип сегмента",
 *       enum={"0 - включение","1 - исключение"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="params",
 *       in="query",
 *       type="string",
 *       description="JSON с параметрами",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по созданному сегменту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SegmentResource")
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
Route::post('/v1/segment/create', 'API\Segment\SegmentController@createSegment');

/**
 * @SWG\Post(
 *     path="/api/v1/segment/{segment}/update",
 *     description="Изменяет сегмент с указанным Id для текущего пользователя",
 *     operationId="updateSegment",
 *     produces={"application/json"},
 *     tags={"segment", "update"},
 *     @SWG\Parameter(
 *       name="name",
 *       in="query",
 *       type="string",
 *       description="Название сегмента",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="status",
 *       in="query",
 *       type="integer",
 *       description="Статус сегмента",
 *       enum={"0 - включен","1 - выключен"},
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по отредактированному сегменту",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SegmentResource")
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
Route::post('/v1/segment/{segment}/update', 'API\Segment\SegmentController@updateSegment');


/**
 * @SWG\Post(
 *     path="/api/v1/{segment}/delete",
 *     description="Удаляет сегмент",
 *     operationId="deleteSegment",
 *     produces={"application/json"},
 *     tags={"segment", "delete"},
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
Route::post('/v1/segment/{segment}/delete', 'API\Segment\SegmentController@deleteSegment');

/**
 * @SWG\Get(
 *     path="/api/v1/segment/list",
 *     description="Возвращает список сегментов для текущего юзера.",
 *     operationId="listSegment",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по сегментам",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/SegmentResource")
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
Route::get('/v1/segment/list', 'API\Segment\SegmentController@getAllSegments');