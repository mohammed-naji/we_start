import './bootstrap';
import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
})

window.Toast = Toast;


import { createApp } from 'vue';

import App from './components/App.vue';

import router from './routes'

createApp(App).use(router).mount('#app');
