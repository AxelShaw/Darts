<?php
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/db.php';

    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    $db = new DB();

    $endpoint = isset($_GET['e']) ? $_GET['e'] : null;

    if (!$endpoint) {
        echo json_encode(['error' => 'No endpoint specified']);
        exit;
    }

    // Charger l'endpoint
    $file = __DIR__ . '/endpoints/' . $endpoint . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo json_encode(['error' => 'Endpoint not found: ' . $endpoint]);
    }
?>
