class Accueil extends Page {
    static name() {
        return 'Accueil';
    }
    
    static icon() {
        return '';
    }
    
    static async onOpen() {
        const images = [
            { src: 'img/images.jpg', name: 'images.jpg' },
            { src: 'img/images.png', name: 'images.png' },
            { src: 'img/téléchargement.png', name: 'téléchargement.png' },
            { src: 'img/téléchargement (1).png', name: 'téléchargement (1).png' },
            { src: 'img/téléchargement (2).png', name: 'téléchargement (2).png' },
            { src: 'img/téléchargement (3).png', name: 'téléchargement (3).png' }
        ];
        
        let html = '<div class="page-header">';
        html += '<h1>Accueil</h1>';
        html += '<p>Gestion des images de loading</p>';
        html += '</div>';
        
        html += '<div style="padding: 30px;">';
        html += '<div class="loading-gallery">';
        html += '<h2>Images disponibles</h2>';
        
        images.forEach(img => {
            html += '<div class="loading-card">';
            html += '<img src="' + img.src + '" alt="' + img.name + '">';
            html += '<div class="card-name">' + img.name + '</div>';
            html += '</div>';
        });
        
        html += '</div>';
        html += '</div>';
        
        Accueil.setContent(html);
    }
}

App.register(Accueil);
