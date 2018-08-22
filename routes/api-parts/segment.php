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
 *     @SWG\Parameter(
 *       name="is_private",
 *       in="query",
 *       type="integer",
 *       description="Отображается ли в общей таблице доступных сегментов или нет",
 *       enum={"0 - не отображается","1 - отображается"},
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

/**
 * @SWG\Get(
 *     path="/api/v1/segment/continents",
 *     description="Возвращает список контитентов для сегментов",
 *     operationId="listCountries",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по континентам",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/ContinentResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/segment/continents', 'API\Segment\SegmentController@getContinentsList');


/**
 * @SWG\Get(
 *     path="/api/v1/segment/countries/{continent}",
 *     description="Возвращает список стран для сегментов",
 *     operationId="listCountries",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Parameter(
 *       name="continent",
 *       in="query",
 *       type="string",
 *       description="Код континента (например, AS)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по странам",
 *         @SWG\Schema(
 *            type="object",
 *            @SWG\Items(ref="#/definitions/CountryResource")
 *         )
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/segment/countries/{continent}', 'API\Segment\SegmentController@getCountriesList');

/**
 * @SWG\Get(
 *     path="/api/v1/segment/areas/{country}",
 *     description="Возвращает список областей для сегментов",
 *     operationId="listAreas",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Parameter(
 *       name="country",
 *       in="query",
 *       type="string",
 *       description="Код страны (например, RU)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/segment/areas/{country}', 'API\Segment\SegmentController@getAreasList');


/**
 * @SWG\Get(
 *     path="/api/v1/segment/cities/{country}/{area}",
 *     description="Возвращает список населённых пунктов для страны и области",
 *     operationId="listCities",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Parameter(
 *       name="country",
 *       in="query",
 *       type="string",
 *       description="Код страны (например, RU)",
 *       default="available",
 *       required=true
 *     ),
 *     @SWG\Parameter(
 *       name="area",
 *       in="query",
 *       type="string",
 *       description="Код области (опционален)",
 *       default="available"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/segment/cities/{country}/{area}', 'API\Segment\SegmentController@getCitiesList');


/**
 * @SWG\Get(
 *     path="/api/v1/segment/languages",
 *     description="Возвращает список языков для таргетирования",
 *     operationId="listOfLanguages",
 *     produces={"application/json"},
 *     tags={"segment", "list"},
 *     @SWG\Response(
 *         response=200,
 *         description="JSON с данными по языкам"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */
Route::get('/v1/segment/languages', 'API\Segment\SegmentController@getLanguagesList');