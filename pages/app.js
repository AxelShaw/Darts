// API
async function api(endpoint, params = {}) {
    const url = new URL('/api/init.php', location.origin);
    url.searchParams.set('e', endpoint);
    
    for (const key in params) {
        url.searchParams.set(key, params[key]);
    }
    
    const response = await fetch(url);
    return response.json();
}

// class base page
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
    }
    
    static onClose() {
    }
}

// Gestion app
class App {
    static currentPage = null;
    static pages = {};
    
    static init() {
        App.showPage('Accueil');
    }
    
    static register(pageClass) {
        App.pages[pageClass.name()] = pageClass;
    }
    
    static showPage(pageName) {
        if (App.currentPage) {
            App.currentPage.onClose();
        }
        
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
