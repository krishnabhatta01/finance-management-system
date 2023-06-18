import './bootstrap';
import { createApp } from 'vue'
import {Dialog, Notify, Quasar} from 'quasar'
// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'
// Import Quasar css
import 'quasar/src/css/index.sass'
import App from './App.vue'
import routes from './routes'
import { createRouter,createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)
app.use(Quasar, {
    plugins: {
        Notify,
        Dialog
    },
})
app.use(router)
app.mount("#app")
