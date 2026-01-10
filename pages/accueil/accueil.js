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
        
        Accueil.setContent(html);
    }
}

App.register(Accueil);
