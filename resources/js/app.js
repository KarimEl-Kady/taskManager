import './bootstrap';
import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

import app from './components/App.vue';

import router from './router';
import '../css/auth.css';

const vueApp = createApp(app);

// Use VueSweetalert2 plugin
vueApp.use(VueSweetalert2);

vueApp.use(router);

vueApp.mount('#app');
