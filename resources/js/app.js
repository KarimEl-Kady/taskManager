import './bootstrap';
import { createApp } from 'vue';
import Swal from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import 'toastr/build/toastr.min.css';
import toastr from 'toastr';

import app from './components/App.vue';

import router from './router';
import '../css/auth.css';
import '../css/home.css';
import Sidebar from './components/Sidebar.vue';
import TaskTable from './components/tasks/Index.vue';



const vueApp = createApp(app);

vueApp.use(Swal);

vueApp.use(router);

vueApp.component('Sidebar', Sidebar);
vueApp.component('TaskTable', TaskTable);



vueApp.mount('#app');
