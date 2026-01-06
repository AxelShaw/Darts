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
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background-pattern"></div>
    
    <div id="app">
        <header>
            <div class="logo">
                <span class="dart-icon">🎯</span>
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <nav>
                <a href="#" class="nav-link active">Accueil</a>
                <a href="#" class="nav-link">Parties</a>
                <a href="#" class="nav-link">Statistiques</a>
            </nav>
        </header>

        <main>
            <section class="hero">
                <div class="hero-content">
                    <h2>Bienvenue sur <span class="highlight">Darts App</span></h2>
                    <p class="subtitle">Gérez vos parties de fléchettes comme un pro</p>
                    
                    <div class="api-status">
                        <span class="status-dot"></span>
                        <span id="api-status-text">Vérification de l'API...</span>
                    </div>
                </div>
                
                <div class="dartboard">
                    <div class="dartboard-inner">
                        <div class="bullseye"></div>
                    </div>
                </div>
            </section>

            <section class="games-section">
                <h3>Modes de jeu disponibles</h3>
                <div id="games-container" class="games-grid">
                    <div class="loading">Chargement des jeux...</div>
                </div>
            </section>

            <section class="hello-section">
                <h3>Tester l'API</h3>
                <div class="hello-form">
                    <input type="text" id="name-input" placeholder="Entrez votre nom..." />
                    <button id="hello-btn">Dire bonjour</button>
                </div>
                <div id="hello-response" class="response-box"></div>
            </section>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?> - Version <?php echo APP_VERSION; ?></p>
        </footer>
    </div>

    <script src="js/main.js"></script>
</body>
</html>
<?php
    Buffering::disableOutput();
?>

