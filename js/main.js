/**
 * DARTS APP - Main JavaScript
 */

const API_BASE = window.location.pathname.replace(/\/[^\/]*$/, '') + '/api.php';

/**
 * Appel API générique
 */
async function apiCall(endpoint, params = {}) {
    const url = new URL(API_BASE, window.location.origin);
    url.searchParams.set('endpoint', endpoint);
    
    Object.keys(params).forEach(key => {
        url.searchParams.set(key, params[key]);
    });

    try {
        const response = await fetch(url);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('API Error:', error);
        return { error: 'network_error' };
    }
}

/**
 * Vérifier le statut de l'API
 */
async function checkApiStatus() {
    const statusText = document.getElementById('api-status-text');
    const statusDot = document.querySelector('.status-dot');
    
    try {
        const response = await fetch(API_BASE);
        const data = await response.json();
        
        if (data.status === 'ok') {
            statusText.textContent = `API connectée - ${data.app} v${data.version}`;
            statusDot.classList.remove('error');
        } else {
            throw new Error('API status not ok');
        }
    } catch (error) {
        statusText.textContent = 'API hors ligne';
        statusDot.classList.add('error');
    }
}

/**
 * Charger les jeux disponibles
 */
async function loadGames() {
    const container = document.getElementById('games-container');
    
    const data = await apiCall('games');
    
    if (data.success && data.games) {
        container.innerHTML = data.games.map(game => `
            <div class="game-card" data-id="${game.id}">
                <h4>${game.name}</h4>
                <p>${game.description}</p>
                <span class="players">👥 ${game.players_min}-${game.players_max} joueurs</span>
            </div>
        `).join('');
        
        // Ajouter les event listeners
        container.querySelectorAll('.game-card').forEach(card => {
            card.addEventListener('click', () => {
                alert(`Jeu sélectionné : ${card.querySelector('h4').textContent}\nFonctionnalité à venir !`);
            });
        });
    } else {
        container.innerHTML = '<div class="loading">Impossible de charger les jeux</div>';
    }
}

/**
 * Tester l'endpoint Hello
 */
async function testHello() {
    const nameInput = document.getElementById('name-input');
    const responseBox = document.getElementById('hello-response');
    
    const name = nameInput.value.trim();
    const params = name ? { name } : {};
    
    responseBox.textContent = 'Chargement...';
    
    const data = await apiCall('hello', params);
    
    responseBox.textContent = JSON.stringify(data, null, 2);
}

/**
 * Initialisation
 */
document.addEventListener('DOMContentLoaded', () => {
    // Vérifier le statut de l'API
    checkApiStatus();
    
    // Charger les jeux
    loadGames();
    
    // Event listener pour le bouton Hello
    document.getElementById('hello-btn').addEventListener('click', testHello);
    
    // Permettre d'appuyer sur Entrée dans l'input
    document.getElementById('name-input').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            testHello();
        }
    });
});

