require('./bootstrap');

// Se crean los elementos de Vue

import { createApp, defineAsyncComponent } from 'vue';
import { Quasar } from 'quasar'
import router from './routers/usuariosRouter.js';

// se importan los componentes

import UsuariosLayout from './components/usuarios/UsuariosLayout.vue'

//Se crea la app y se anexan los componentes y plugins

createApp({
    components : {
        // app
        'usuarios-layout': UsuariosLayout,
    },
})  
    .use(router)
    .use(Quasar)
    .mount("#usuario")
