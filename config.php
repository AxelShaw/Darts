<?php
    /*
        ENVIRONMENT
    */
    define('DIRECTORY', '/darts');
    define('ENVIRONMENT', 'Production');

    /*
        ERRORS HANDLING
    */
    error_reporting(E_ALL);
    ini_set('display_errors', ENVIRONMENT != 'Production' ? 1 : 0);
    ini_set('display_startup_errors', ENVIRONMENT != 'Production' ? 1 : 0);

    /*
        SESSION
    */
    session_start();

    /*
        DATABASE (à configurer selon tes besoins)
    */
    // if(ENVIRONMENT == 'Production') {
    //     define('DB_HOST', 'localhost');
    //     define('DB_NAME', 'darts_prod');
    //     define('DB_USER', 'root');
    //     define('DB_PASS', '');
    // }
    // else {
    //     define('DB_HOST', 'localhost');
    //     define('DB_NAME', 'darts_dev');
    //     define('DB_USER', 'root');
    //     define('DB_PASS', '');
    // }

    /*
        APP CONFIG
    */
    define('APP_NAME', 'Darts App');
    define('APP_VERSION', '1.0.0');
?>

