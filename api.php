<?php
    require_once __DIR__.'/config.php';
    require_once __DIR__.'/include/loader.php';

    Buffering::enableOutput();

    // CORS headers pour le développement
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    if(!empty($_GET['endpoint']) && $_GET['endpoint'] != 'api') {
        $endpoint_file = __DIR__.'/api/'.$_GET['endpoint'].'.php';
        
        if(file_exists($endpoint_file)) {
            include $endpoint_file;
        }
        else {
            Buffering::output(array('error' => 'endpoint_not_found'));
        }
    }
    else {
        Buffering::output(array(
            'app' => APP_NAME,
            'version' => APP_VERSION,
            'status' => 'ok'
        ));
    }

    Buffering::disableOutput();
?>

