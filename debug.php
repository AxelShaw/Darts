<?php
header('Content-Type: application/json');

require_once __DIR__.'/config.php';

echo json_encode([
    'DB_HOST' => DB_HOST,
    'DB_PORT' => DB_PORT,
    'DB_NAME' => DB_NAME,
    'DB_USER' => DB_USER,
    'DB_PASS_last3' => '***' . substr(DB_PASS, -3),
    'MYSQLHOST_env' => getenv('MYSQLHOST') ?: 'NOT SET',
    'MYSQL_HOST_env' => getenv('MYSQL_HOST') ?: 'NOT SET',
    'MYSQL_PUBLIC_URL' => getenv('MYSQL_PUBLIC_URL') ? 'SET' : 'NOT SET',
    'DATABASE_URL' => getenv('DATABASE_URL') ? 'SET' : 'NOT SET',
]);
?>
