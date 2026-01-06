<?php
    // Debug - affiche les variables de connexion
    echo json_encode([
        'success' => true,
        'debug' => [
            'DB_HOST' => DB_HOST,
            'DB_PORT' => DB_PORT,
            'DB_NAME' => DB_NAME,
            'DB_USER' => DB_USER,
            'DB_PASS' => '***' . substr(DB_PASS, -3), // Montre juste les 3 derniers caractères
            'MYSQLHOST_env' => getenv('MYSQLHOST') ?: 'not set',
            'MYSQL_HOST_env' => getenv('MYSQL_HOST') ?: 'not set',
        ]
    ]);
?>
