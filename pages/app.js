// API call
async function api(endpoint, params = {}) {
    const url = new URL('/api/init.php', location.origin);

    url.searchParams.set('e', endpoint);
    
    for (const key in params) {
        url.searchParams.set(key, params[key]);
    }
    
    const response = await fetch(url);
    return response.json();
}
