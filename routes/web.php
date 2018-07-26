<?php



// Show face page
Route::get('/', 'Face\IndexController@getIndex');

/**
 * @SWG\Get(
 *     path="/banner/get",
 *     description="Возвращает статический баннер",
 *     operationId="dummyStaticBanner",
 *     produces={"image/jpg", "image/png", "image/gif"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Статический баннер (рандомный, но статический)",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/banner/get', 'API\Banner\BannerController@getRandom');


/**
 * @SWG\Get(
 *     path="/banner/get/{type}",
 *     description="Возвращает баннер по его типу",
 *     operationId="dummyStaticSizedBanner",
 *     produces={"image/jpg", "image/png", "image/gif"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Статический баннер заданного размера, согласно типу",
 *     ),
 *     @SWG\Parameter(
 *         name="type",
 *         in="path",
 *         description="ID типа баннера",
 *         required=true,
 *         type="string",
 *         enum={
 *              "0 - простой баннер-заглушка",
 *              "1 - карусель (пока сама карусель не сделана, но страничка для неё подготовлена, тестовые баннеры помещены",
 *              "2 - три в ряд (есть адаптив)",
 *              "3 - баннер 200 x 200",
 *              "4 - баннер 240 x 400",
 *              "5 - баннер 250 x 250",
 *              "6 - баннер 250 x 360",
 *              "7 - баннер 300 x 250",
 *              "8 - баннер 336 x 280",
 *              "9 - баннер 580 x 400",
 *              "10 - баннер 120 x 600",
 *              "11 - баннер 160 x 600",
 *              "12 - баннер 300 x 1050",
 *              "13 - баннер 468 x 60",
 *              "14 - баннер 728 x 90",
 *              "15 - баннер 930 x 180",
 *              "16 - баннер 970 x 90",
 *              "17 - баннер 970 x 250",
 *              "18 - баннер 980 x 120",
 *              "19 - текстовый баннер"
 *         }
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */


Route::get('/banner/get/{type}', 'API\Banner\BannerController@getByType');


/**
 * @SWG\Get(
 *     path="/banner/get/{type}/preview",
 *     description="Возвращает заглушку баннера при наличии у пользователя администраторских прав",
 *     operationId="dummyPreviewBanner",
 *     produces={"image/jpg", "image/png", "image/gif"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Статический баннер-заглушка заданного размера, согласно типу",
 *     ),
 *     @SWG\Parameter(
 *         name="type",
 *         in="path",
 *         description="ID типа баннера. Список возможных значений такой же, как в /banner/get/{type}",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/banner/get/{type}/preview', 'API\Banner\BannerController@showPreview');


/**
 * @SWG\Get(
 *     path="/code",
 *     description="Возвращает код, который подключает API с клиентской стороны. Вызов используется внутри админки, чтобы дать пользователю персонифицированный скрипт, который надо вставить на страницу",
 *     operationId="counterCode",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Код, который запрашивает API",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/code', 'API\Banner\BannerController@getCode');


/**
 * @SWG\Get(
 *     path="/api/{version}/{api_key}",
 *     description="Получает API и его основную функциональность",
 *     operationId="getApi",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Parameter(
 *         name="{api_key}",
 *         in="path",
 *         description="Ключ API",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Parameter(
 *         name="{version}",
 *         in="path",
 *         description="Версия. По умолчанию, параметр равен v1",
 *         required=true,
 *         type="string"
 *     ),
 *     @SWG\Response(
 *         response=200,
 *         description="API первой версии",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Ресурс не найден",
 *     )
 * )
 */

Route::get('/api/{version}/{api_key}', 'API\Banner\BannerController@getApi');


/**
 * @SWG\Get(
 *     path="/testpage",
 *     description="Получает тестовую страницу с рабочим кодом",
 *     operationId="getTestApiPage",
 *     produces={"application/json"},
 *     tags={"banner"},
 *     @SWG\Response(
 *         response=200,
 *         description="Статическая страница",
 *     ),
 *     @SWG\Response(
 *         response=404,
 *         description="Страница не найдена",
 *     )
 * )
 */

Route::get('/testpage', 'Face\IndexController@getTestStaticPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/client-show', 'UI\ClientController@getClientAdv');