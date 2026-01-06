<?php
    /*
        Endpoint: /api/hello
        Description: Simple hello world endpoint
    */

    $name = !empty($_GET['name']) ? htmlspecialchars($_GET['name']) : 'World';

    Buffering::output(array(
        'success' => true,
        'message' => 'Hello, ' . $name . '!',
        'timestamp' => date('Y-m-d H:i:s')
    ));
?>

