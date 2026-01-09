class Accueil extends Page {
    static name() {
        return 'Accueil';
    }
    
    static icon() {
        return '';
    }
    
    static async onOpen() {
        let html = '';
        html += '<div id="loading-test">';
        html += '<img src="assets/loading.gif" alt="Loading...">';
        html += '<p>Chargement...</p>';
        html += '</div>';
        
        Accueil.setContent(html);
    }
}

App.register(Accueil);
