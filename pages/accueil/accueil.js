class Accueil extends Page {
    static name() {
        return 'Accueil';
    }
    
    static icon() {
        return '';
    }
    
    static async onOpen() {
        let html = '<div class="page-header">';
        html += '<h1>Accueil</h1>';
        html += '</div>';
        
        html += '<div class="accueil-content">';
        html += '<div class="accueil-welcome">';
        html += '<img src="img/dart2.png" alt="Darts" class="accueil-img">';
        html += '<h2>Bienvenue !</h2>';
        html += '<p>Utilisez le menu pour naviguer dans l\'application.</p>';
        html += '</div>';
        html += '</div>';
        
        Accueil.setContent(html);
    }
}

App.register(Accueil);
