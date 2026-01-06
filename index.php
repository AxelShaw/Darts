<?php
    require_once __DIR__.'/config.php';
    require_once __DIR__.'/include/loader.php';

    Buffering::enableOutput();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
</head>
<body>
    <h1>Hello World</h1>
    <p>Version: <?php echo APP_VERSION; ?></p>
</body>
</html>
<?php
    Buffering::disableOutput();
?>
