<?php

/**
 * @SWG\Swagger(
 *     schemes={"http", "https"},
 *     host="coin-api.dev.digital-lab.ru",
 *     basePath="/",
 *     @SWG\Info(
 *         version="0.0.1",
 *         title="Документация на API по криптобирже",
 *         description="Это документация по API криптобиржи. API состоит из двух частей, надеемся, что оно будет со временем прозрачным :)",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="k.kosorukov@digital-lab.ru"
 *         ),
 *     )
 * )
 *
 *
 */


/**
 * @SWG\Tag(
 *   name="user",
 *   description="Всё о вас самих, вашей рекламе и баннерах",
 * )
 * @SWG\Tag(
 *   name="auth",
 *   description="Раздел об аутентификации и авторизации"
 * )
 * @SWG\Tag(
 *   name="banner",
 *   description="Всё о баннерах, визуальная и API часть"
 * )
 * @SWG\Tag(
 *   name="adv",
 *   description="Всё об объявлениях (сторона рекламодателя)"
 * )
 * @SWG\Tag(
 *   name="advgroup",
 *   description="Группы объявлений (сторона рекламодателя)"
 * )
 * @SWG\Tag(
 *   name="container",
 *   description="Баннерные контейнеры (сторона вебмастера)"
 * )
 * @SWG\Tag(
 *   name="campaign",
 *   description="Кампании (сторона рекламодателя)"
 * )
 * @SWG\Tag(
 *   name="project",
 *   description="Проекты (сторона рекламодателя)"
 * )
 * @SWG\Tag(
 *   name="segment",
 *   description="Сегменты (сторона рекламодателя)"
 * )
 * @SWG\Tag(
 *   name="geo",
 *   description="Геолокация (все стороны)"
 * )
 */


require_once 'api-parts/auth.php'; // Auth routes
require_once 'api-parts/container.php'; // Container routes
require_once 'api-parts/user.php'; // User routes
require_once 'api-parts/banner.php'; // Banner routes
require_once 'api-parts/campaign.php'; // Banner routes
require_once 'api-parts/advgroup.php'; // AdvGroup routes
require_once 'api-parts/adv.php'; // Adv routes
require_once 'api-parts/secretquestion.php'; // Adv routes
require_once 'api-parts/site.php'; // Site routes
require_once 'api-parts/project.php'; // Project routes
require_once 'api-parts/segment.php'; // Segment routes
require_once 'api-parts/manager.php'; // Manager routes
require_once 'api-parts/webmaster.php'; // Webmaster routes
require_once 'api-parts/geo.php'; // Geo routes
require_once 'api-parts/system.php'; // System routes