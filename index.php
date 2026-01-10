<?php require_once __DIR__.'/config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="pages/accueil/accueil.css">
    <link rel="stylesheet" href="pages/changelog/changelog.css">
</head>
<body>
    <div id="sidebar">
        <div class="logo"><?= APP_NAME ?></div>
        <div class="nav-item active" data-page="Accueil" onclick="App.showPage('Accueil')">
            Accueil
        </div>
        <div class="sidebar-bottom">
            <div class="nav-item" data-page="Changelog" onclick="App.showPage('Changelog')">
                Changelog
            </div>
        </div>
    </div>
    
    <div id="main">
        <div id="content"></div>
        
        <div id="loading">
            <img src="img/dart1.png" alt="Chargement..." class="loading-img">
        </div>
    </div>
    
    <script src="pages/app.js"></script>
    <script src="pages/accueil/accueil.js"></script>
    <script src="pages/changelog/changelog.js"></script>
    <script>
        App.init();
        
        api('releases').then(data => {
            console.log('<?= APP_NAME ?> (' + (data.current_version || 'dev') + ')');
        });
    </script>
</body>
</html>
