<?php


/**
 * @SWG\Get(
 *     path="/api/v1/geo/all",
 *     description="Возвращает содержимое файла с геолокейшенами",
 *     operationId="getAllGeodata",
 *     produces={"application/json"},
 *     tags={"geo"},
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

Route::get('/v1/geo/all', 'API\System\GeoController@getJsonInfo');
