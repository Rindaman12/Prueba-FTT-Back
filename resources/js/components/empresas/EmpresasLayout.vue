<template>
    <q-layout view="hHh lpR fFf">
        <q-header
            reveal
            elevated
            class="bg-dark text-white"
            style=""
            height-hint="98"
        >
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="/img/ftt_logo.png" />
                    </q-avatar>
                    FAST TRACK TALENT
                </q-toolbar-title>
            </q-toolbar>

            <q-tabs align="left">
                <q-route-tab to="/empresas/inicio" label="Inicio" />
                <q-route-tab>
                    <a
                        class="link"
                        @click.prevent="logout"
                        href="/empresa/logout"
                        >Cerrar Sesion</a
                    >
                    <form
                        id="logout-form"
                        :action="'/empresa/logout'"
                        method="POST"
                    >
                        <input-csfr /></form
                ></q-route-tab>
            </q-tabs>
        </q-header>

        <q-page-container>
            <router-view />
        </q-page-container>

        <q-footer reveal elevated class="footer">
            <small>
                <div align="center">
                    <strong
                        >Copyright &copy; 2022
                        <a href="/">FAST TRACK TALENT</a>.</strong
                    >
                    Todos los derechos Reservados. Creado Por
                    <a
                        href="https://torre.co/en/luispena1098?utm_source=windu&utm_medium=web&utm_campaign=search-people&utm_term=kqf8fex1p"
                        >Luis Peña</a
                    >
                </div>
            </small>
        </q-footer>
    </q-layout>
</template>

<script>
import Csfr from "./Csrf";

export default {
    components: {
        inputCsfr: Csfr,
    },
    methods: {
        logout() {
            document.getElementById("logout-form").submit();
            localStorage.tabs = "[]";
        },
    },
};
</script>

<style scoped>
.link {
    text-decoration: none;
    color: white;
}
</style>
