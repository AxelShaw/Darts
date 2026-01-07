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
        console.log('--- DEBUG RELEASES ---');
        const response = await fetch('/api/init.php?e=releases');
        console.log('Response status:', response.status);
        console.log('Response ok:', response.ok);
        
        const text = await response.text();
        console.log('Raw response:', text);
        
        let data;
        try {
            data = JSON.parse(text);
            console.log('Parsed data:', data);
        } catch (e) {
            console.error('JSON parse error:', e);
            releasesDiv.innerHTML = `<p class="error">Erreur JSON: ${e.message}<br><pre>${text}</pre></p>`;
            return;
        }
        
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
            console.error('API error:', data);
            releasesDiv.innerHTML = `<p class="error">Erreur: ${data.error}</p><pre>${JSON.stringify(data.debug, null, 2)}</pre>`;
        }
    } catch (error) {
        console.error('Fetch error:', error);
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
