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
        
        // Debug version
        console.log('--- DEBUG VERSION ---');
        console.log('__DIR__:', '<?= __DIR__ ?>');
        console.log('git tag result:', '<?= @shell_exec("git describe --tags --abbrev=0 2>&1") ?>');
        console.log('git tag list:', '<?= @shell_exec("git tag 2>&1") ?>');
        console.log('git status:', '<?= @shell_exec("git status 2>&1 | head -1") ?>');
        console.log('is git repo:', '<?= is_dir(__DIR__ . "/.git") ? "YES .git exists" : "NO .git not found" ?>');
    </script>
    <script src="pages/app.js"></script>
    <script src="pages/accueil/accueil.js"></script>
</body>
</html>