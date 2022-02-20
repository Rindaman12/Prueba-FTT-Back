// Router
import { createWebHistory, createRouter } from "vue-router";

const routes = [
  {
    path: "/empresas/inicio",
    name: "EMPinicio",
    component: () =>
      import(
        /* webpackPrefetch: true */
        /* webpackChunkName: "EMPinicioPage" */
        "../components/empresas/Inicio.vue"
      ),
    props: true,
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
