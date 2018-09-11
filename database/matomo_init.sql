-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.23 - MySQL Community Server (GPL)
-- Операционная система:         Linux
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица forge.matomo_access
DROP TABLE IF EXISTS `matomo_access`;
CREATE TABLE IF NOT EXISTS `matomo_access` (
  `login` varchar(100) NOT NULL,
  `idsite` int(10) unsigned NOT NULL,
  `access` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`login`,`idsite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_access: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_access` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_goal
DROP TABLE IF EXISTS `matomo_goal`;
CREATE TABLE IF NOT EXISTS `matomo_goal` (
  `idsite` int(11) NOT NULL,
  `idgoal` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `match_attribute` varchar(20) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `pattern_type` varchar(10) NOT NULL,
  `case_sensitive` tinyint(4) NOT NULL,
  `allow_multiple` tinyint(4) NOT NULL,
  `revenue` float NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idsite`,`idgoal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_goal: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_goal` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_goal` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_logger_message
DROP TABLE IF EXISTS `matomo_logger_message`;
CREATE TABLE IF NOT EXISTS `matomo_logger_message` (
  `idlogger_message` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `level` varchar(16) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`idlogger_message`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_logger_message: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_logger_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_logger_message` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_action
DROP TABLE IF EXISTS `matomo_log_action`;
CREATE TABLE IF NOT EXISTS `matomo_log_action` (
  `idaction` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text,
  `hash` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `url_prefix` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`idaction`),
  KEY `index_type_hash` (`type`,`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_action: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_action` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_conversion
DROP TABLE IF EXISTS `matomo_log_conversion`;
CREATE TABLE IF NOT EXISTS `matomo_log_conversion` (
  `idvisit` bigint(10) unsigned NOT NULL,
  `idsite` int(10) unsigned NOT NULL,
  `idvisitor` binary(8) NOT NULL,
  `server_time` datetime NOT NULL,
  `idaction_url` int(10) unsigned DEFAULT NULL,
  `idlink_va` bigint(10) unsigned DEFAULT NULL,
  `idgoal` int(10) NOT NULL,
  `buster` int(10) unsigned NOT NULL,
  `idorder` varchar(100) DEFAULT NULL,
  `items` smallint(5) unsigned DEFAULT NULL,
  `url` text NOT NULL,
  `visitor_days_since_first` smallint(5) unsigned DEFAULT NULL,
  `visitor_days_since_order` smallint(5) unsigned DEFAULT NULL,
  `visitor_returning` tinyint(1) DEFAULT NULL,
  `visitor_count_visits` int(11) unsigned NOT NULL,
  `referer_keyword` varchar(255) DEFAULT NULL,
  `referer_name` varchar(70) DEFAULT NULL,
  `referer_type` tinyint(1) unsigned DEFAULT NULL,
  `config_device_brand` varchar(100) DEFAULT NULL,
  `config_device_model` varchar(100) DEFAULT NULL,
  `config_device_type` tinyint(100) DEFAULT NULL,
  `location_city` varchar(255) DEFAULT NULL,
  `location_country` char(3) DEFAULT NULL,
  `location_latitude` decimal(9,6) DEFAULT NULL,
  `location_longitude` decimal(9,6) DEFAULT NULL,
  `location_region` char(3) DEFAULT NULL,
  `revenue` float DEFAULT NULL,
  `revenue_discount` float DEFAULT NULL,
  `revenue_shipping` float DEFAULT NULL,
  `revenue_subtotal` float DEFAULT NULL,
  `revenue_tax` float DEFAULT NULL,
  `custom_var_k1` varchar(200) DEFAULT NULL,
  `custom_var_v1` varchar(200) DEFAULT NULL,
  `custom_var_k2` varchar(200) DEFAULT NULL,
  `custom_var_v2` varchar(200) DEFAULT NULL,
  `custom_var_k3` varchar(200) DEFAULT NULL,
  `custom_var_v3` varchar(200) DEFAULT NULL,
  `custom_var_k4` varchar(200) DEFAULT NULL,
  `custom_var_v4` varchar(200) DEFAULT NULL,
  `custom_var_k5` varchar(200) DEFAULT NULL,
  `custom_var_v5` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idvisit`,`idgoal`,`buster`),
  UNIQUE KEY `unique_idsite_idorder` (`idsite`,`idorder`),
  KEY `index_idsite_datetime` (`idsite`,`server_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_conversion: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_conversion` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_conversion` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_conversion_item
DROP TABLE IF EXISTS `matomo_log_conversion_item`;
CREATE TABLE IF NOT EXISTS `matomo_log_conversion_item` (
  `idsite` int(10) unsigned NOT NULL,
  `idvisitor` binary(8) NOT NULL,
  `server_time` datetime NOT NULL,
  `idvisit` bigint(10) unsigned NOT NULL,
  `idorder` varchar(100) NOT NULL,
  `idaction_sku` int(10) unsigned NOT NULL,
  `idaction_name` int(10) unsigned NOT NULL,
  `idaction_category` int(10) unsigned NOT NULL,
  `idaction_category2` int(10) unsigned NOT NULL,
  `idaction_category3` int(10) unsigned NOT NULL,
  `idaction_category4` int(10) unsigned NOT NULL,
  `idaction_category5` int(10) unsigned NOT NULL,
  `price` float NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`idvisit`,`idorder`,`idaction_sku`),
  KEY `index_idsite_servertime` (`idsite`,`server_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_conversion_item: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_conversion_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_conversion_item` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_link_visit_action
DROP TABLE IF EXISTS `matomo_log_link_visit_action`;
CREATE TABLE IF NOT EXISTS `matomo_log_link_visit_action` (
  `idlink_va` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsite` int(10) unsigned NOT NULL,
  `idvisitor` binary(8) NOT NULL,
  `idvisit` bigint(10) unsigned NOT NULL,
  `idaction_url_ref` int(10) unsigned DEFAULT '0',
  `idaction_name_ref` int(10) unsigned DEFAULT NULL,
  `custom_float` float DEFAULT NULL,
  `server_time` datetime NOT NULL,
  `idpageview` char(6) DEFAULT NULL,
  `interaction_position` smallint(5) unsigned DEFAULT NULL,
  `idaction_name` int(10) unsigned DEFAULT NULL,
  `idaction_url` int(10) unsigned DEFAULT NULL,
  `time_spent_ref_action` int(10) unsigned DEFAULT NULL,
  `idaction_event_action` int(10) unsigned DEFAULT NULL,
  `idaction_event_category` int(10) unsigned DEFAULT NULL,
  `idaction_content_interaction` int(10) unsigned DEFAULT NULL,
  `idaction_content_name` int(10) unsigned DEFAULT NULL,
  `idaction_content_piece` int(10) unsigned DEFAULT NULL,
  `idaction_content_target` int(10) unsigned DEFAULT NULL,
  `custom_var_k1` varchar(200) DEFAULT NULL,
  `custom_var_v1` varchar(200) DEFAULT NULL,
  `custom_var_k2` varchar(200) DEFAULT NULL,
  `custom_var_v2` varchar(200) DEFAULT NULL,
  `custom_var_k3` varchar(200) DEFAULT NULL,
  `custom_var_v3` varchar(200) DEFAULT NULL,
  `custom_var_k4` varchar(200) DEFAULT NULL,
  `custom_var_v4` varchar(200) DEFAULT NULL,
  `custom_var_k5` varchar(200) DEFAULT NULL,
  `custom_var_v5` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idlink_va`),
  KEY `index_idvisit` (`idvisit`),
  KEY `index_idsite_servertime` (`idsite`,`server_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_link_visit_action: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_link_visit_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_link_visit_action` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_profiling
DROP TABLE IF EXISTS `matomo_log_profiling`;
CREATE TABLE IF NOT EXISTS `matomo_log_profiling` (
  `query` text NOT NULL,
  `count` int(10) unsigned DEFAULT NULL,
  `sum_time_ms` float DEFAULT NULL,
  UNIQUE KEY `query` (`query`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_profiling: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_profiling` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_profiling` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_log_visit
DROP TABLE IF EXISTS `matomo_log_visit`;
CREATE TABLE IF NOT EXISTS `matomo_log_visit` (
  `idvisit` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsite` int(10) unsigned NOT NULL,
  `idvisitor` binary(8) NOT NULL,
  `visit_last_action_time` datetime NOT NULL,
  `config_id` binary(8) NOT NULL,
  `location_ip` varbinary(16) NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `visit_first_action_time` datetime NOT NULL,
  `visit_goal_buyer` tinyint(1) DEFAULT NULL,
  `visit_goal_converted` tinyint(1) DEFAULT NULL,
  `visitor_days_since_first` smallint(5) unsigned DEFAULT NULL,
  `visitor_days_since_order` smallint(5) unsigned DEFAULT NULL,
  `visitor_returning` tinyint(1) DEFAULT NULL,
  `visitor_count_visits` int(11) unsigned NOT NULL,
  `visit_entry_idaction_name` int(10) unsigned DEFAULT NULL,
  `visit_entry_idaction_url` int(11) unsigned DEFAULT NULL,
  `visit_exit_idaction_name` int(10) unsigned DEFAULT NULL,
  `visit_exit_idaction_url` int(10) unsigned DEFAULT '0',
  `visit_total_actions` int(11) unsigned DEFAULT NULL,
  `visit_total_interactions` smallint(5) unsigned DEFAULT '0',
  `visit_total_searches` smallint(5) unsigned DEFAULT NULL,
  `referer_keyword` varchar(255) DEFAULT NULL,
  `referer_name` varchar(70) DEFAULT NULL,
  `referer_type` tinyint(1) unsigned DEFAULT NULL,
  `referer_url` text,
  `location_browser_lang` varchar(20) DEFAULT NULL,
  `config_browser_engine` varchar(10) DEFAULT NULL,
  `config_browser_name` varchar(10) DEFAULT NULL,
  `config_browser_version` varchar(20) DEFAULT NULL,
  `config_device_brand` varchar(100) DEFAULT NULL,
  `config_device_model` varchar(100) DEFAULT NULL,
  `config_device_type` tinyint(100) DEFAULT NULL,
  `config_os` char(3) DEFAULT NULL,
  `config_os_version` varchar(100) DEFAULT NULL,
  `visit_total_events` int(11) unsigned DEFAULT NULL,
  `visitor_localtime` time DEFAULT NULL,
  `visitor_days_since_last` smallint(5) unsigned DEFAULT NULL,
  `config_resolution` varchar(18) DEFAULT NULL,
  `config_cookie` tinyint(1) DEFAULT NULL,
  `config_director` tinyint(1) DEFAULT NULL,
  `config_flash` tinyint(1) DEFAULT NULL,
  `config_gears` tinyint(1) DEFAULT NULL,
  `config_java` tinyint(1) DEFAULT NULL,
  `config_pdf` tinyint(1) DEFAULT NULL,
  `config_quicktime` tinyint(1) DEFAULT NULL,
  `config_realplayer` tinyint(1) DEFAULT NULL,
  `config_silverlight` tinyint(1) DEFAULT NULL,
  `config_windowsmedia` tinyint(1) DEFAULT NULL,
  `visit_total_time` int(11) unsigned NOT NULL,
  `location_city` varchar(255) DEFAULT NULL,
  `location_country` char(3) DEFAULT NULL,
  `location_latitude` decimal(9,6) DEFAULT NULL,
  `location_longitude` decimal(9,6) DEFAULT NULL,
  `location_region` char(3) DEFAULT NULL,
  `custom_var_k1` varchar(200) DEFAULT NULL,
  `custom_var_v1` varchar(200) DEFAULT NULL,
  `custom_var_k2` varchar(200) DEFAULT NULL,
  `custom_var_v2` varchar(200) DEFAULT NULL,
  `custom_var_k3` varchar(200) DEFAULT NULL,
  `custom_var_v3` varchar(200) DEFAULT NULL,
  `custom_var_k4` varchar(200) DEFAULT NULL,
  `custom_var_v4` varchar(200) DEFAULT NULL,
  `custom_var_k5` varchar(200) DEFAULT NULL,
  `custom_var_v5` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idvisit`),
  KEY `index_idsite_config_datetime` (`idsite`,`config_id`,`visit_last_action_time`),
  KEY `index_idsite_datetime` (`idsite`,`visit_last_action_time`),
  KEY `index_idsite_idvisitor` (`idsite`,`idvisitor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_log_visit: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_log_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_log_visit` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_option
DROP TABLE IF EXISTS `matomo_option`;
CREATE TABLE IF NOT EXISTS `matomo_option` (
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL,
  `autoload` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_option: ~134 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_option` DISABLE KEYS */;
INSERT INTO `matomo_option` (`option_name`, `option_value`, `autoload`) VALUES
	('MobileMessaging_DelegatedManagement', 'false', 0),
	('piwikUrl', '%s', 1),
	('PrivacyManager.doNotTrackEnabled', '1', 0),
	('PrivacyManager.ipAnonymizerEnabled', '1', 0),
	('SitesManager_DefaultTimezone', 'Europe/Moscow', 0),
	('UpdateCheck_LastTimeChecked', '1535686673', 1),
	('UpdateCheck_LatestVersion', '3.6.0', 0),
	('useridsalt', 'PIKDHI99Ln6tOsKujzAjpxhVpLYy-G3z4nWk0wWI', 1),
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
/*!40000 ALTER TABLE `matomo_option` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_plugin_setting
DROP TABLE IF EXISTS `matomo_plugin_setting`;
CREATE TABLE IF NOT EXISTS `matomo_plugin_setting` (
  `plugin_name` varchar(60) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` longtext NOT NULL,
  `json_encoded` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_login` varchar(100) NOT NULL DEFAULT '',
  KEY `plugin_name` (`plugin_name`,`user_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_plugin_setting: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_plugin_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_plugin_setting` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_privacy_logdata_anonymizations
DROP TABLE IF EXISTS `matomo_privacy_logdata_anonymizations`;
CREATE TABLE IF NOT EXISTS `matomo_privacy_logdata_anonymizations` (
  `idlogdata_anonymization` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idsites` text,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `anonymize_ip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `anonymize_location` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `anonymize_userid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `unset_visit_columns` text NOT NULL,
  `unset_link_visit_action_columns` text NOT NULL,
  `output` mediumtext,
  `scheduled_date` datetime DEFAULT NULL,
  `job_start_date` datetime DEFAULT NULL,
  `job_finish_date` datetime DEFAULT NULL,
  `requester` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idlogdata_anonymization`),
  KEY `job_start_date` (`job_start_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_privacy_logdata_anonymizations: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_privacy_logdata_anonymizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_privacy_logdata_anonymizations` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_report
DROP TABLE IF EXISTS `matomo_report`;
CREATE TABLE IF NOT EXISTS `matomo_report` (
  `idreport` int(11) NOT NULL AUTO_INCREMENT,
  `idsite` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `idsegment` int(11) DEFAULT NULL,
  `period` varchar(10) NOT NULL,
  `hour` tinyint(4) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `format` varchar(10) NOT NULL,
  `reports` text NOT NULL,
  `parameters` text,
  `ts_created` timestamp NULL DEFAULT NULL,
  `ts_last_sent` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idreport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_report: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_report` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_segment
DROP TABLE IF EXISTS `matomo_segment`;
CREATE TABLE IF NOT EXISTS `matomo_segment` (
  `idsegment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `definition` text NOT NULL,
  `login` varchar(100) NOT NULL,
  `enable_all_users` tinyint(4) NOT NULL DEFAULT '0',
  `enable_only_idsite` int(11) DEFAULT NULL,
  `auto_archive` tinyint(4) NOT NULL DEFAULT '0',
  `ts_created` timestamp NULL DEFAULT NULL,
  `ts_last_edit` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idsegment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_segment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_segment` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_segment` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_sequence
DROP TABLE IF EXISTS `matomo_sequence`;
CREATE TABLE IF NOT EXISTS `matomo_sequence` (
  `name` varchar(120) NOT NULL,
  `value` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_sequence: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_sequence` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_sequence` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_session
DROP TABLE IF EXISTS `matomo_session`;
CREATE TABLE IF NOT EXISTS `matomo_session` (
  `id` varchar(255) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_session: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_session` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_site
DROP TABLE IF EXISTS `matomo_site`;
CREATE TABLE IF NOT EXISTS `matomo_site` (
  `idsite` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `main_url` varchar(255) NOT NULL,
  `ts_created` timestamp NULL DEFAULT NULL,
  `ecommerce` tinyint(4) DEFAULT '0',
  `sitesearch` tinyint(4) DEFAULT '1',
  `sitesearch_keyword_parameters` text NOT NULL,
  `sitesearch_category_parameters` text NOT NULL,
  `timezone` varchar(50) NOT NULL,
  `currency` char(3) NOT NULL,
  `exclude_unknown_urls` tinyint(1) DEFAULT '0',
  `excluded_ips` text NOT NULL,
  `excluded_parameters` text NOT NULL,
  `excluded_user_agents` text NOT NULL,
  `group` varchar(250) NOT NULL,
  `type` varchar(255) NOT NULL,
  `keep_url_fragment` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idsite`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_site: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_site` DISABLE KEYS */;
INSERT INTO `matomo_site` (`idsite`, `name`, `main_url`, `ts_created`, `ecommerce`, `sitesearch`, `sitesearch_keyword_parameters`, `sitesearch_category_parameters`, `timezone`, `currency`, `exclude_unknown_urls`, `excluded_ips`, `excluded_parameters`, `excluded_user_agents`, `group`, `type`, `keep_url_fragment`) VALUES
	(1, 'First website', '%s', '2018-08-31 03:39:11', 0, 1, '', '', 'Europe/Moscow', 'USD', 0, '', '', '', '', 'website', 0);
/*!40000 ALTER TABLE `matomo_site` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_site_setting
DROP TABLE IF EXISTS `matomo_site_setting`;
CREATE TABLE IF NOT EXISTS `matomo_site_setting` (
  `idsite` int(10) unsigned NOT NULL,
  `plugin_name` varchar(60) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` longtext NOT NULL,
  `json_encoded` tinyint(3) unsigned NOT NULL DEFAULT '0',
  KEY `idsite` (`idsite`,`plugin_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_site_setting: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_site_setting` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_site_setting` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_site_url
DROP TABLE IF EXISTS `matomo_site_url`;
CREATE TABLE IF NOT EXISTS `matomo_site_url` (
  `idsite` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`idsite`,`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_site_url: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_site_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_site_url` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_user
DROP TABLE IF EXISTS `matomo_user`;
CREATE TABLE IF NOT EXISTS `matomo_user` (
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alias` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token_auth` char(32) NOT NULL,
  `superuser_access` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `date_registered` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`login`),
  UNIQUE KEY `uniq_keytoken` (`token_auth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_user` DISABLE KEYS */;
INSERT INTO `matomo_user` (`login`, `password`, `alias`, `email`, `token_auth`, `superuser_access`, `date_registered`) VALUES
	('admin', '$2y$10$6f9Ux.IVNOLZHF5Xt/1Vk.8v7ws0WR8RXbk5G1ocxeUq2YxfI./jC', 'admin', '%s', '56a6ce47263d662407ca9ee5f545395b', 1, '2018-08-31 03:38:29'),
	('anonymous', '', 'anonymous', 'anonymous@example.org', 'anonymous', 0, '2018-08-31 03:37:05');
/*!40000 ALTER TABLE `matomo_user` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_user_dashboard
DROP TABLE IF EXISTS `matomo_user_dashboard`;
CREATE TABLE IF NOT EXISTS `matomo_user_dashboard` (
  `login` varchar(100) NOT NULL,
  `iddashboard` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `layout` text NOT NULL,
  PRIMARY KEY (`login`,`iddashboard`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_user_dashboard: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_user_dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_user_dashboard` ENABLE KEYS */;

-- Дамп структуры для таблица forge.matomo_user_language
DROP TABLE IF EXISTS `matomo_user_language`;
CREATE TABLE IF NOT EXISTS `matomo_user_language` (
  `login` varchar(100) NOT NULL,
  `language` varchar(10) NOT NULL,
  `use_12_hour_clock` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы forge.matomo_user_language: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `matomo_user_language` DISABLE KEYS */;
/*!40000 ALTER TABLE `matomo_user_language` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
