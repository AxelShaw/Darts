<?php
    // DB
    define('DB_HOST', getenv('MYSQL_HOST'));
    define('DB_PORT', getenv('MYSQL_PORT'));
    define('DB_NAME', getenv('MYSQL_DATABASE'));
    define('DB_USER', getenv('MYSQL_USER'));
    define('DB_PASS', getenv('MYSQL_PASSWORD'));

    // App
    define('APP_NAME', 'Darts App');
    
    // Version (dernier commit Git)
    $gitCommit = @shell_exec('git rev-parse --short HEAD 2>/dev/null');
    define('APP_VERSION', $gitCommit ? trim($gitCommit) : 'dev');
?>

