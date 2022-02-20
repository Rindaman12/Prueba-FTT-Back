require('./bootstrap');

// Se crean los elementos de Vue

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/empresasRouter.js';

// se importan los componentes

import EmpresasLayout from './components/empresas/EmpresasLayout.vue'

//Se crea la app y se anexan los componentes y plugins

createApp({
    components : {
        // app
        'empresas-layout': EmpresasLayout,
    },
})  
    .use(router)
    .use(Quasar)
    .mount("#empresa")
