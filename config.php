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
    // Railway utilise les deux formats, on teste les deux
    define('DB_HOST', getenv('MYSQLHOST') ?: getenv('MYSQL_HOST') ?: '127.0.0.1');
    define('DB_PORT', getenv('MYSQLPORT') ?: getenv('MYSQL_PORT') ?: '3306');
    define('DB_NAME', getenv('MYSQLDATABASE') ?: getenv('MYSQL_DATABASE') ?: 'railway');
    define('DB_USER', getenv('MYSQLUSER') ?: getenv('MYSQL_USER') ?: 'root');
    define('DB_PASS', getenv('MYSQLPASSWORD') ?: getenv('MYSQL_PASSWORD') ?: '');

    /*
        APP CONFIG
    */
    define('APP_NAME', 'Darts App');
    define('APP_VERSION', '1.0.0');
?>

