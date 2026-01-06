<?php
    // Database
    define('DB_HOST', getenv('MYSQL_HOST'));
    define('DB_PORT', getenv('MYSQL_PORT'));
    define('DB_NAME', getenv('MYSQL_DATABASE'));
    define('DB_USER', getenv('MYSQL_USER'));
    define('DB_PASS', getenv('MYSQL_PASSWORD'));

    // App
    define('APP_NAME', 'Darts App');
    
    // Version : fichier VERSION ou commit SHA Railway
    $versionFile = __DIR__ . '/VERSION';
    define('APP_VERSION', file_exists($versionFile) ? trim(file_get_contents($versionFile)) : '0.0.0');
?>

