<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql-backoffice'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'mysql-backoffice' => [
            'driver' => 'mysql',
            'host' => env('BACKOFFICE_DB_HOST', '127.0.0.1'),
            'port' => env('UI_DB_PORT', '3306'),
            'database' => env('BACKOFFICE_DB_DATABASE', 'forge'),
            'username' => env('BACKOFFICE_DB_USERNAME', 'forge'),
            'password' => env('BACKOFFICE_DB_PASSWORD', ''),
            'unix_socket' => env('BACKOFFICE_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
            'options' => [
                \PDO::MYSQL_ATTR_LOCAL_INFILE => true
            ]
        ],

        'mysql-ui' => [
            'driver' => 'mysql',
            'host' => env('UI_DB_HOST', '127.0.0.1'),
            'port' => env('UI_DB_PORT', '3306'),
            'database' => env('UI_DB_DATABASE', 'forge'),
            'username' => env('UI_DB_USERNAME', 'forge'),
            'password' => env('UI_DB_PASSWORD', ''),
            'unix_socket' => env('UI_DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

        'geocode-cache' => [ // choose an appropriate name
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 1, // be sure this number differs from your other redis databases
        ],

    ],

];
