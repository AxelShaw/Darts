// ============================================
// API Helper
// ============================================
async function api(endpoint, params = {}) {
    const url = new URL('/api/init.php', location.origin);
    url.searchParams.set('e', endpoint);
    
    for (const key in params) {
        url.searchParams.set(key, params[key]);
    }
    
    const response = await fetch(url);
    return response.json();
}

// ============================================
// Classe de base Page (comme Module dans Panel)
// ============================================
class Page {
    static name() {
        return 'Page';
    }
    
    static icon() {
        return '';
    }
    
    static container() {
        return document.getElementById('content');
    }
    
    static setContent(html) {
        const container = this.container();
        if (container) {
            container.innerHTML = html;
        }
        App.hideLoading();
    }
    
    static onOpen() {
        // Override dans les pages
    }
    
    static onClose() {
        // Override dans les pages
    }
}

// ============================================
// Gestionnaire App (comme Panel)
// ============================================
class App {
    static currentPage = null;
    static pages = {};
    
    static init() {
        // Charger la page par défaut
        App.showPage('Accueil');
    }
    
    static register(pageClass) {
        App.pages[pageClass.name()] = pageClass;
    }
    
    static showPage(pageName) {
        // Fermer la page actuelle
        if (App.currentPage) {
            App.currentPage.onClose();
        }
        
        // Ouvrir la nouvelle page
        const page = App.pages[pageName];
        if (page) {
            App.currentPage = page;
            App.showLoading();
            App.updateNav(pageName);
            page.onOpen();
        }
    }
    
    static showLoading() {
        const loading = document.getElementById('loading');
        if (loading) loading.style.display = 'flex';
    }
    
    static hideLoading() {
        const loading = document.getElementById('loading');
        if (loading) loading.style.display = 'none';
    }
    
    static updateNav(activePage) {
        document.querySelectorAll('#sidebar .nav-item').forEach(el => {
            el.classList.toggle('active', el.dataset.page === activePage);
        });
    }
}
