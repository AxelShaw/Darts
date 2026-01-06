<?php
    $results = $db->get("SELECT * FROM test");

    echo json_encode([
        'success' => true,
        'data' => $results
    ]);
?>