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
    <div id="sidebar">
        <div class="logo">🎯 <?= APP_NAME ?></div>
        <div class="nav-item active" data-page="Accueil" onclick="App.showPage('Accueil')">
            Accueil
        </div>
    </div>
    
    <div id="main">
        <div id="content"></div>
        
        <div id="loading">
            <div class="spinner"></div>
        </div>
    </div>
    
    <script src="pages/app.js"></script>
    <script src="pages/accueil/accueil.js"></script>
    <script>
        App.init();
        
        api('releases').then(data => {
            console.log('<?= APP_NAME ?> (' + (data.current_version || 'dev') + ')');
        });
    </script>
</body>
</html>
