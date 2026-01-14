class Modes extends Page {
    static name() {
        return 'Modes';
    }
    
    static icon() {
        return '';
    }
    
    static gameModes = [
        {
            id: '301',
            name: '301',
            description: 'Partez de 301 points et atteignez exactement 0.',
            icon: '🎯',
            color: '#3498db'
        },
        {
            id: '501',
            name: '501',
            description: 'Partez de 501 points et atteignez exactement 0.',
            icon: '🏆',
            color: '#e74c3c'
        },
        {
            id: 'cricket',
            name: 'Cricket',
            description: 'Fermez les numéros 15 à 20 et le bullseye.',
            icon: '🦗',
            color: '#27ae60'
        }
    ];
    
    static async onOpen() {
        let html = '<div class="page-header">';
        html += '<h1>Modes de Jeu</h1>';
        html += '<p>Choisissez votre mode de jeu préféré</p>';
        html += '</div>';
        
        html += '<div class="modes-grid">';
        
        for (const mode of this.gameModes) {
            html += `<div class="mode-card" onclick="Modes.selectMode('${mode.id}')" style="--mode-color: ${mode.color}">`;
            html += `<div class="mode-icon">${mode.icon}</div>`;
            html += `<h3 class="mode-name">${mode.name}</h3>`;
            html += `<p class="mode-description">${mode.description}</p>`;
            html += `<button class="mode-btn">Jouer</button>`;
            html += '</div>';
        }
        
        html += '</div>';
        
        Modes.setContent(html);
    }
    
    static selectMode(modeId) {
        const mode = this.gameModes.find(m => m.id === modeId);
        if (mode) {
            alert(`Mode "${mode.name}" sélectionné !`);
        }
    }
}

App.register(Modes);
