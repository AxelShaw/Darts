// Fonctions globales pour toutes les pages

async function callApi(endpoint, params = {}) {
    const url = new URL('/api/', window.location.origin);
    url.searchParams.set('e', endpoint);
    
    for (const [key, value] of Object.entries(params)) {
        url.searchParams.set(key, value);
    }
    
    const response = await fetch(url);
    return await response.json();
}
