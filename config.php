<?php
    /*
        ENVIRONMENT
    */
    define('ENVIRONMENT', 'Production');

    /*
        ERRORS HANDLING
    */
    error_reporting(E_ALL);
    ini_set('display_errors', ENVIRONMENT != 'Production' ? 1 : 0);
    ini_set('display_startup_errors', ENVIRONMENT != 'Production' ? 1 : 0);

    /*
        DATABASE
    */
    define('DB_HOST', getenv('MYSQL_HOST') ?: 'localhost');
    define('DB_PORT', getenv('MYSQL_PORT') ?: '3306');
    define('DB_NAME', getenv('MYSQL_DATABASE') ?: 'railway');
    define('DB_USER', getenv('MYSQL_USER') ?: 'root');
    define('DB_PASS', getenv('MYSQL_PASSWORD') ?: '');

    /*
        APP CONFIG
    */
    define('APP_NAME', 'Darts App');
    define('APP_VERSION', '1.0.0');
?>

