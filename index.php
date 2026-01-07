<?php require_once __DIR__.'/config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="pages/accueil/accueil.css">
</head>
<body>
    <script>
        console.log('<?= APP_NAME ?> (<?= APP_VERSION ?>)');
    </script>
    <script src="pages/app.js"></script>
    <script src="pages/accueil/accueil.js"></script>
</body>
</html>