class Changelog extends Page {
    static name() {
        return 'Changelog';
    }
    
    static icon() {
        return '';
    }
    
    static async onOpen() {
        const data = await api('releases');
        
        let html = '<div class="changelog-container">';
        html += '<div class="page-header">';
        html += '<h1>Changelog</h1>';
        html += '<p class="version">Version actuelle: <span>' + (data.current_version || '...') + '</span></p>';
        html += '</div>';
        
        if (data.success && data.releases.length > 0) {
            data.releases.forEach(release => {
                const date = new Date(release.date).toLocaleDateString('fr-FR', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                
                const displayTag = release.tag.replace(/^v/, '');
                
                html += '<div class="release">';
                html += '<div class="release-header">';
                html += '<span class="release-tag">' + displayTag + '</span>';
                html += '<span class="release-date">' + date + '</span>';
                html += '</div>';
                html += '<h3 class="release-name">' + (release.name || release.tag) + '</h3>';
                html += '<div class="release-description">' + Changelog.formatDescription(release.description) + '</div>';
                html += '</div>';
            });
        } else if (data.error) {
            html += '<p class="error">Erreur: ' + data.error + '</p>';
        }
        
        html += '</div>';
        
        Changelog.setContent(html);
    }
    
    static formatDescription(text) {
        if (!text) return '<em>Pas de description</em>';
        
        return text
            .replace(/^- (.*)/gm, '• $1')
            .replace(/\n/g, '<br>')
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/`(.*?)`/g, '<code>$1</code>');
    }
}

App.register(Changelog);
