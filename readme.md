This is backend part of adv platform. Written on Laravel 5 and more :)

Okay, if you want to install them, don't forget about .env file :) Below is the list with required variables data:


* BACKOFFICE_DB_HOST=[host_backoffice_database] # Host for backoffice database
* BACKOFFICE_DB_DATABASE=[backoffice-database-name] # Backoffice database name
* BACKOFFICE_DB_USERNAME=[backoffice-db-instance-username] # Backoffice database username
* BACKOFFICE_DB_PASSWORD=[backoffice-db-password-username] # Backoffice database password


* UI_DB_HOST=[host_ui_database] # Host for showcase database
* UI_DB_DATABASE=[ui-database-name] # Showcase database name
* UI_DB_USERNAME=[ui-db-instance-username] # Showcase database username
* UI_DB_PASSWORD=[ui-db-password-username] # Showcase database password

* APP_KEY=[laravel_app_key] # Laravel app key
* JWT_SECRET=[jwt_secret] # JWT secret key


* MAIL_HOST=[mail_smtp_host] # SMTP host
* SMTP_USERNAME=[mail_smtp_username] # SMTP username
* SMTP_PASSWORD=[mail_smtp_password] # SMTP password
* MAILGUN_DOMAIN=[mailgun_domain] # Mailgun domain, if you use mailgun
* MAILGUN_SECRET=[mailgun_secret] # Mailgun secret, if you use mailgun


* COIN_FRONT_URL=[not_used] # Not used


* DB_CONNECTION=[default_db_connection] # Default db connection
* GEONAMES_API_URL=http://api.geonames.org
* GEONAMES_LOGIN=[geonames_api_login]
* MAXMIND_DB_FILE=geobase/GeoLite2-City_20180703/GeoLite2-City.mmdb
* CITIES_CSV_FILE=geobase/GeoLite2-City_20180703/GeoLite2-City-Locations-ru.csv

