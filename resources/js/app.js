import Alpine from 'alpinejs';
import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Alpine = Alpine;

Alpine.data('recipeFinderTheme', () => ({
    darkMode: localStorage.getItem('recipe-finder-theme') === 'dark'
        || (! localStorage.getItem('recipe-finder-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

    toggle() {
        this.darkMode = ! this.darkMode;
        localStorage.setItem('recipe-finder-theme', this.darkMode ? 'dark' : 'light');
    },
}));

Alpine.start();
