// Fonctions globales pour toutes les pages

async function callApi(endpoint, params = {}) {
    const url = new URL('/api/index.php', window.location.origin);
    url.searchParams.set('e', endpoint);
    
    for (const [key, value] of Object.entries(params)) {
        url.searchParams.set(key, value);
    }
    
    const response = await fetch(url);
    const text = await response.text();

    try {
        return JSON.parse(text);
    } catch (e) {
        console.error('Réponse API brute:', text);
        throw new Error('JSON.parse: ' + text.substring(0, 100));
    }
}
