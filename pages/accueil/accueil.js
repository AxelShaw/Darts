// Page Accueil
document.body.innerHTML = `
    <div class="container">
        <h1>🎯 Darts App</h1>
        <p class="version">Version: <span id="current-version">...</span></p>
        
        <h2>📋 Changelog</h2>
        <div id="releases">Chargement des releases...</div>
    </div>
`;

// Charger les releases
async function loadAccueil() {
    const releasesDiv = document.getElementById('releases');
    const versionSpan = document.getElementById('current-version');
    
    try {
        const data = await api('releases');
        
        if (data.success) {
            versionSpan.textContent = data.current_version;
            
            if (data.releases.length > 0) {
                let html = '';
                
                data.releases.forEach(release => {
                    const date = new Date(release.date).toLocaleDateString('fr-FR', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    html += `
                        <div class="release ${release.prerelease ? 'prerelease' : ''}">
                            <div class="release-header">
                                <span class="release-tag">${release.tag}</span>
                                ${release.prerelease ? '<span class="badge-prerelease">Pre-release</span>' : ''}
                                <span class="release-date">${date}</span>
                            </div>
                            <h3 class="release-name">${release.name || release.tag}</h3>
                            <div class="release-description">${formatDescription(release.description)}</div>
                            <a href="${release.url}" target="_blank" class="release-link">Voir sur GitHub →</a>
                        </div>
                    `;
                });
                
                releasesDiv.innerHTML = html;
            } else {
                releasesDiv.innerHTML = '<p class="no-releases">Aucune release disponible. Crée ta première release sur GitHub !</p>';
            }
        } else {
            releasesDiv.innerHTML = `<p class="error">Erreur: ${data.error}</p>`;
        }
    } catch (error) {
        releasesDiv.innerHTML = `<p class="error">Erreur: ${error.message}</p>`;
    }
}

// Formater la description (markdown basique)
function formatDescription(text) {
    if (!text) return '<em>Pas de description</em>';
    
    return text
        .replace(/\n/g, '<br>')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        .replace(/\*(.*?)\*/g, '<em>$1</em>')
        .replace(/^- (.*)/gm, '• $1')
        .replace(/`(.*?)`/g, '<code>$1</code>');
}

loadAccueil();
