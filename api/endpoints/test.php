<?php
    $results = $db->query("SELECT * FROM test");

    echo json_encode([
        'success' => true,
        'data' => $results
    ]);
?>
