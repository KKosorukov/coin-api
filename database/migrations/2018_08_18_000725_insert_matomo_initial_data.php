<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertMatomoInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = <<<SQL
INSERT INTO matomo_option (option_name, option_value, autoload) VALUES  ('MobileMessaging_DelegatedManagement', 'false', 0),
('piwikUrl', '%s', 1),
('PrivacyManager.doNotTrackEnabled', '1', 0),
('PrivacyManager.ipAnonymizerEnabled', '0', 0),
('SitesManager_DefaultTimezone', 'Europe/Moscow', 0),
('UpdateCheck_LastTimeChecked', '1534550447', 1),
('UpdateCheck_LatestVersion', '3.5.1', 0),
('useridsalt', 'wB4osffwJV30FCtVmKAu6\$jrZivHem-FNAtnITTP', 1),
('version_Actions', '3.5.1', 1),
('version_Annotations', '3.5.1', 1),
('version_API', '3.5.1', 1),
('version_BulkTracking', '3.5.1', 1),
('version_Contents', '3.5.1', 1),
('version_core', '3.5.1', 1),
('version_CoreAdminHome', '3.5.1', 1),
('version_CoreConsole', '3.5.1', 1),
('version_CoreHome', '3.5.1', 1),
('version_CorePluginsAdmin', '3.5.1', 1),
('version_CoreUpdater', '3.5.1', 1),
('version_CoreVisualizations', '3.5.1', 1),
('version_CustomPiwikJs', '3.5.1', 1),
('version_CustomVariables', '3.5.1', 1),
('version_Dashboard', '3.5.1', 1),
('version_DevicePlugins', '3.5.1', 1),
('version_DevicesDetection', '3.5.1', 1),
('version_Diagnostics', '3.5.1', 1),
('version_Ecommerce', '3.5.1', 1),
('version_Events', '3.5.1', 1),
('version_ExampleAPI', '1.0', 1),
('version_ExamplePlugin', '0.1.0', 1),
('version_Feedback', '3.5.1', 1),
('version_GeoIp2', '3.5.1', 1),
('version_Goals', '3.5.1', 1),
('version_Heartbeat', '3.5.1', 1),
('version_ImageGraph', '3.5.1', 1),
('version_Insights', '3.5.1', 1),
('version_Installation', '3.5.1', 1),
('version_Intl', '3.5.1', 1),
('version_LanguagesManager', '3.5.1', 1),
('version_Live', '3.5.1', 1),
('version_Login', '3.5.1', 1),
('version_log_conversion.revenue', 'float default NULL', 1),
('version_log_conversion.revenue_discount', 'float default NULL', 1),
('version_log_conversion.revenue_shipping', 'float default NULL', 1),
('version_log_conversion.revenue_subtotal', 'float default NULL', 1),
('version_log_conversion.revenue_tax', 'float default NULL', 1),
('version_log_link_visit_action.idaction_content_interaction', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_content_name', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_content_piece', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_content_target', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_event_action', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_event_category', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idaction_name', 'INTEGER(10) UNSIGNED', 1),
('version_log_link_visit_action.idaction_url', 'INTEGER(10) UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.idpageview', 'CHAR(6) NULL DEFAULT NULL', 1),
('version_log_link_visit_action.interaction_position', 'SMALLINT UNSIGNED DEFAULT NULL', 1),
('version_log_link_visit_action.server_time', 'DATETIME NOT NULL', 1),
('version_log_link_visit_action.time_spent_ref_action', 'INTEGER(10) UNSIGNED NULL', 1),
('version_log_visit.config_browser_engine', 'VARCHAR(10) NULL', 1),
('version_log_visit.config_browser_name', 'VARCHAR(10) NULL', 1),
('version_log_visit.config_browser_version', 'VARCHAR(20) NULL', 1),
('version_log_visit.config_cookie', 'TINYINT(1) NULL', 1),
('version_log_visit.config_device_brand', 'VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL1', 1),
('version_log_visit.config_device_model', 'VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL1', 1),
('version_log_visit.config_device_type', 'TINYINT( 100 ) NULL DEFAULT NULL1', 1),
('version_log_visit.config_director', 'TINYINT(1) NULL', 1),
('version_log_visit.config_flash', 'TINYINT(1) NULL', 1),
('version_log_visit.config_gears', 'TINYINT(1) NULL', 1),
('version_log_visit.config_java', 'TINYINT(1) NULL', 1),
('version_log_visit.config_os', 'CHAR(3) NULL', 1),
('version_log_visit.config_os_version', 'VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL', 1),
('version_log_visit.config_pdf', 'TINYINT(1) NULL', 1),
('version_log_visit.config_quicktime', 'TINYINT(1) NULL', 1),
('version_log_visit.config_realplayer', 'TINYINT(1) NULL', 1),
('version_log_visit.config_resolution', 'VARCHAR(18) NULL', 1),
('version_log_visit.config_silverlight', 'TINYINT(1) NULL', 1),
('version_log_visit.config_windowsmedia', 'TINYINT(1) NULL', 1),
('version_log_visit.location_browser_lang', 'VARCHAR(20) NULL', 1),
('version_log_visit.location_city', 'varchar(255) DEFAULT NULL1', 1),
('version_log_visit.location_country', 'CHAR(3) NULL1', 1),
('version_log_visit.location_latitude', 'decimal(9, 6) DEFAULT NULL1', 1),
('version_log_visit.location_longitude', 'decimal(9, 6) DEFAULT NULL1', 1),
('version_log_visit.location_region', 'char(3) DEFAULT NULL1', 1),
('version_log_visit.referer_keyword', 'VARCHAR(255) NULL1', 1),
('version_log_visit.referer_name', 'VARCHAR(70) NULL1', 1),
('version_log_visit.referer_type', 'TINYINT(1) UNSIGNED NULL1', 1),
('version_log_visit.referer_url', 'TEXT NULL', 1),
('version_log_visit.user_id', 'VARCHAR(200) NULL', 1),
('version_log_visit.visitor_count_visits', 'INT(11) UNSIGNED NOT NULL1', 1),
('version_log_visit.visitor_days_since_first', 'SMALLINT(5) UNSIGNED NULL1', 1),
('version_log_visit.visitor_days_since_last', 'SMALLINT(5) UNSIGNED NULL', 1),
('version_log_visit.visitor_days_since_order', 'SMALLINT(5) UNSIGNED NULL1', 1),
('version_log_visit.visitor_localtime', 'TIME NULL', 1),
('version_log_visit.visitor_returning', 'TINYINT(1) NULL1', 1),
('version_log_visit.visit_entry_idaction_name', 'INTEGER(10) UNSIGNED NULL', 1),
('version_log_visit.visit_entry_idaction_url', 'INTEGER(11) UNSIGNED NULL  DEFAULT NULL', 1),
('version_log_visit.visit_exit_idaction_name', 'INTEGER(10) UNSIGNED NULL', 1),
('version_log_visit.visit_exit_idaction_url', 'INTEGER(10) UNSIGNED NULL DEFAULT 0', 1),
('version_log_visit.visit_first_action_time', 'DATETIME NOT NULL', 1),
('version_log_visit.visit_goal_buyer', 'TINYINT(1) NULL', 1),
('version_log_visit.visit_goal_converted', 'TINYINT(1) NULL', 1),
('version_log_visit.visit_total_actions', 'INT(11) UNSIGNED NULL', 1),
('version_log_visit.visit_total_events', 'INT(11) UNSIGNED NULL', 1),
('version_log_visit.visit_total_interactions', 'SMALLINT UNSIGNED DEFAULT 0', 1),
('version_log_visit.visit_total_searches', 'SMALLINT(5) UNSIGNED NULL', 1),
('version_log_visit.visit_total_time', 'INT(11) UNSIGNED NOT NULL', 1),
('version_Marketplace', '3.5.1', 1),
('version_MobileMessaging', '3.5.1', 1),
('version_Monolog', '3.5.1', 1),
('version_Morpheus', '3.5.1', 1),
('version_MultiSites', '3.5.1', 1),
('version_Overlay', '3.5.1', 1),
('version_PrivacyManager', '3.5.1', 1),
('version_ProfessionalServices', '3.5.1', 1),
('version_Proxy', '3.5.1', 1),
('version_Referrers', '3.5.1', 1),
('version_Resolution', '3.5.1', 1),
('version_RssWidget', '1.0', 1),
('version_ScheduledReports', '3.5.1', 1),
('version_SegmentEditor', '3.5.1', 1),
('version_SEO', '3.5.1', 1),
('version_SitesManager', '3.5.1', 1),
('version_TestRunner', '0.1.0', 1),
('version_Transitions', '3.5.1', 1),
('version_UserCountry', '3.5.1', 1),
('version_UserCountryMap', '3.5.1', 1),
('version_UserId', '3.5.1', 1),
('version_UserLanguage', '3.5.1', 1),
('version_UsersManager', '3.5.1', 1),
('version_VisitFrequency', '3.5.1', 1),
('version_VisitorInterest', '3.5.1', 1),
('version_VisitsSummary', '3.5.1', 1),
('version_VisitTime', '3.5.1', 1),
('version_WebsiteMeasurable', '3.5.1', 1),
('version_Widgetize', '3.5.1', 1);
SQL;

        DB::statement(
            sprintf(
                $query,
                env('MATOMO_BASE_URL', 'http://piwik.mac.digital-lab.ru/')
            )
        );
        $query = <<<SQL
INSERT INTO matomo_site (idsite, name, main_url, ts_created, ecommerce, sitesearch, sitesearch_keyword_parameters, sitesearch_category_parameters, timezone, currency, exclude_unknown_urls, excluded_ips, excluded_parameters, excluded_user_agents, `group`, type, keep_url_fragment) VALUES (1, 'test', '%s', '2018-08-18 00:02:02', 0, 1, '', '', 'Europe/Moscow', 'USD', 0, '', '', '', '', 'website', 0);
SQL;
        DB::statement(
            sprintf(
                $query,
                env('MATOMO_BASE_URL','http://piwik.mac.digital-lab.ru/')
            )
        );
        $query = <<<SQL
INSERT INTO matomo_user (login, password, alias, email, token_auth, superuser_access, date_registered) VALUES
    ('admin', '$2y$10$0T5uPtjOunxoA9BRkDMd8.qz9d.x9d0PvW8CREif7Aea7gjyhYgn2', 'admin', '%s', 'fddd3526631ef46b019ccacc46ac045b', 1, '2018-08-18 00:01:17'),
    ('anonymous', '', 'anonymous', 'anonymous@example.org', 'anonymous', 0, '2018-08-17 23:59:44');
SQL;

        DB::statement(
            sprintf(
                $query,
                env('MATOMO_ADMIN_EMAIL', 'admin@digital-lab.ru')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(
            'truncate table matomo_option;'
        );
        DB::statement(
            'truncate table matomo_site;'
        );
        DB::statement(
            'truncate table matomo_user;'
        );
    }
}
