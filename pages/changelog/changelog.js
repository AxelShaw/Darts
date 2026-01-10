class Changelog extends Page {
    static name() {
        return 'Changelog';
    }
    
    static icon() {
        return '';
    }
    
    static async onOpen() {
        let html = '<div class="changelog-container">';
        html += '<div class="page-header">';
        html += '<h1>Changelog</h1>';
        html += '<p class="version">Version actuelle: <span id="current-version">...</span></p>';
        html += '</div>';
        html += '<div id="releases">Chargement...</div>';
        html += '</div>';
        
        Changelog.setContent(html);
        
        const data = await api('releases');
        
        if (data.success) {
            document.getElementById('current-version').textContent = data.current_version;
            
            let releasesHtml = '';
            
            if (data.releases.length > 0) {
                data.releases.forEach(release => {
                    const date = new Date(release.date).toLocaleDateString('fr-FR', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    const displayTag = release.tag.replace(/^v/, '');
                    
                    releasesHtml += '<div class="release">';
                    releasesHtml += '<div class="release-header">';
                    releasesHtml += '<span class="release-tag">' + displayTag + '</span>';
                    if (release.prerelease) {
                        releasesHtml += '<span class="badge-prerelease">Pre-release</span>';
                    }
                    releasesHtml += '<span class="release-date">' + date + '</span>';
                    releasesHtml += '</div>';
                    releasesHtml += '<h3 class="release-name">' + (release.name || release.tag) + '</h3>';
                    releasesHtml += '<div class="release-description">' + Changelog.formatDescription(release.description) + '</div>';
                    releasesHtml += '</div>';
                });
            } else {
                releasesHtml = '<p class="no-releases">Aucune release disponible.</p>';
            }
            
            document.getElementById('releases').innerHTML = releasesHtml;
        } else {
            document.getElementById('releases').innerHTML = '<p class="error">Erreur: ' + data.error + '</p>';
        }
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
