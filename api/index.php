<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/db.php';

    try {
        $db = new DB();
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'DB: ' . $e->getMessage()]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }

    $endpoint = isset($_GET['e']) ? $_GET['e'] : null;

    if (!$endpoint) {
        echo json_encode(['success' => false, 'error' => 'No endpoint specified']);
        exit;
    }

    $file = __DIR__ . '/endpoints/' . $endpoint . '.php';

    if (file_exists($file)) {
        try {
            require_once $file;
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'Query: ' . $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Endpoint not found: ' . $endpoint]);
    }
?>
