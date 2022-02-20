require('./bootstrap');

// Se crean los elementos de Vue

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/welcomeRouter.js';

// se importan los componentes

import WelcomeLayout from './components/welcome/WelcomeLayout.vue'

//Se crea la app y se anexan los componentes y plugins

createApp({
    components : {
        // app
        'welcome-layout': WelcomeLayout,
    },
})  
    .use(router)
    .use(Quasar)
    .mount("#welcome")
