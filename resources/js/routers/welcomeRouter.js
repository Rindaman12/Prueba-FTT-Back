// Router
import { createWebHistory, createRouter } from "vue-router";

const routes = [
  {
    path: "/",
    name: "welcome",
    component: () =>
      import(
        /* webpackPrefetch: true */
        /* webpackChunkName: "welcomePage" */
        "../components/welcome/WelcomeView.vue"
      ),
    props: true,
  },

  {
    path: "/loginEmp",
    name: "loginEmp",
    component: () =>
      import(
        /* webpackChunkName: "LoginEmpPage" */
        "../components/welcome/LoginEmpresa.vue"
      ),
    props: true,
  },

  {
    path: "/registrarEmp",
    name: "registrarEmp",
    component: () =>
      import(
        /* webpackChunkName: "registrarEmpPage" */
        "../components/welcome/RegistrarEmpresa.vue"
      ),
    props: true,
  },

  {
    path: "/loginUser",
    name: "loginUser",
    component: () =>
      import(
        /* webpackChunkName: "loginUserPage" */
        "../components/welcome/LoginUsuario.vue"
      ),
    props: true,
  },


];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
