// Router
import { createWebHistory, createRouter } from "vue-router";

const routes = [
  {
    path: "/usuarios",
    name: "Userinicio",
    component: () =>
      import(
        /* webpackPrefetch: true */
        /* webpackChunkName: "UserinicioPage" */
        "../components/usuarios/Usuarios.vue"
      ),
    props: true,
  },

  {
    path: "/personal",
    name: "Personalinicio",
    component: () =>
      import(
        /* webpackChunkName: "PersonalPage" */
        "../components/usuarios/Personal.vue"
      ),
    props: true,
  },

  {
    path: "/empresas",
    name: "Empresasinicio",
    component: () =>
      import(
        /* webpackChunkName: "EmpresasPage" */
        "../components/usuarios/Empresas.vue"
      ),
    props: true,
  },

  {
    path: "/cargos",
    name: "Cargosinicio",
    component: () =>
      import(
        /* webpackChunkName: "CargosPage" */
        "../components/usuarios/Cargos.vue"
      ),
    props: true,
  },

  {
    path: "/postulaciones",
    name: "Postulacionesinicio",
    component: () =>
      import(
        /* webpackChunkName: "PostulacionesPage" */
        "../components/usuarios/Postulaciones.vue"
      ),
    props: true,
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
