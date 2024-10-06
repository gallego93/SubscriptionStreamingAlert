import './bootstrap';
import Alpine from 'alpinejs';
import 'trix/dist/trix.css';
import 'trix';
import { createApp } from 'vue'; // Importar Vue
import DarkModeToggle from './components/DarkModeToggle.vue'; // Importar componente de modo oscuro

// Iniciar Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Iniciar Vue.js
const app = createApp({
    // Aquí puedes agregar opciones globales si las necesitas
});

// Registrar componente DarkModeToggle globalmente
app.component('dark-mode-toggle', DarkModeToggle);

// Montar la app de Vue en el div con id="app"
app.mount('#app');
