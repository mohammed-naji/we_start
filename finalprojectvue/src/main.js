import { createApp } from 'vue'
import { createPinia } from 'pinia'
// import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { createI18n } from 'vue-i18n'

import App from './App.vue'
import router from './router'

import './assets/style.css'
import '@fortawesome/fontawesome-free/css/all.css'

import axios from 'axios'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'

import iziToast from 'izitoast'
import 'iziToast/dist/css/iziToast.min.css'

window.axios = axios;
window.toastr = toastr;
window.iziToast = iziToast;

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1';

const pinia = createPinia()
// pinia.use(piniaPluginPersistedstate)

pinia.use(context => {
    const storeId = context.store.$id

    const serializer = {
        serialize: JSON.stringify,
        deserialize: JSON.parse
    }

    const data = serializer.deserialize(window.localStorage.getItem(storeId))

    if(data) {
        context.store.$patch(data)
    }

    context.store.$subscribe((m, s) => {
        window.localStorage.setItem(storeId, serializer.serialize(s))
    })

})

import messages from './messages'

const i18n = createI18n({
    locale: localStorage.getItem('locale') ?? 'ar' , // set locale
    fallbackLocale: 'en', // set fallback locale
    messages, // set locale messages
});

const app = createApp(App)
app.use(pinia)
app.use(router)
app.use(i18n)
app.mount('#app')
