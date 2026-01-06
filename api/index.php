<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/db.php';

    try {
        $db = new DB();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'DB connection failed']);
        exit;
    }

    $endpoint = isset($_GET['e']) ? $_GET['e'] : null;

    if (!$endpoint) {
        echo json_encode(['success' => false, 'error' => 'No endpoint specified']);
        exit;
    }

    $file = __DIR__ . '/endpoints/' . $endpoint . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        echo json_encode(['success' => false, 'error' => 'Endpoint not found: ' . $endpoint]);
    }
?>
