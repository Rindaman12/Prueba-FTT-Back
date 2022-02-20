<template>
    <div class="main">
        <div class="headers bg-dark">
            <h2 class="text-green" style="font-weight: bold">
                Registrar Empresa
            </h2>
            <div class="q-pa-md row items-start q-gutter-md">
                <q-card class="my-card text-white">
                    <q-form
                    method="POST"
                        @submit.prevent="registerEMP"
                        @reset="onReset"
                        class="q-gutter-md"
                    >
                        <input-csfr />

                        <q-card-section class="q-pt-none">
                            <q-input
                                filled
                                v-model="razon"
                                name="razon"
                                label="Razon Social"
                                hint="Coloque su Razon Social"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Por Favor Escribe Algo.',
                                ]"
                            />
                        </q-card-section>

                        <q-separator inset />

                        <q-card-section class="q-pt-none">
                            <q-input
                                filled
                                v-model="rif"
                                name="rif"
                                label="RIF"
                                hint="Coloque su RIF"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Por Favor Escribe Algo.',
                                ]"
                            />
                        </q-card-section>

                        <q-separator inset />

                        <q-card-section class="q-pt-none">
                            <q-input
                                filled
                                v-model="tlf"
                                name="tlf"
                                label="Numero Telefonico"
                                hint="Coloque su numero telefonico"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Por Favor Escribe Algo.',
                                ]"
                            />
                        </q-card-section>

                        <q-separator inset />

                        <q-card-section class="q-pt-none">
                            <q-input
                                filled
                                v-model="email"
                                name="email"
                                label="Correo Electronico"
                                hint="Coloque su correo electronico"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Por Favor Escribe Algo.',
                                ]"
                            />
                        </q-card-section>

                        <q-separator inset />

                        <q-card-section class="q-pt-none">
                            <q-input
                                filled
                                v-model="password"
                                type="password"
                                name="password"
                                label="Contraseña"
                                hint="Coloque su contraseña"
                                lazy-rules
                                :rules="[
                                    (val) =>
                                        (val && val.length > 0) ||
                                        'Por Favor Escribe Algo.',
                                ]"
                            />
                        </q-card-section>

                        <q-separator inset />

                        <q-card-section>
                            <div>
                                <q-btn
                                    label="Enviar"
                                    type="submit"
                                    color="green"
                                    name="enviar"
                                />
                                <q-btn
                                    label="Limpiar"
                                    type="reset"
                                    color="green"
                                    class="q-ml-sm"
                                />
                            </div>
                        </q-card-section>
                    </q-form>
                </q-card>
            </div>
        </div>
    </div>
    <particles-bg
        type="random"
        :canvas="{ backgroundColor: '#000000' }"
        :bg="true"
    />
</template>

<script>
import { ref } from "vue";
import Csfr from "./Csrf";
import Swal from "sweetalert2";
import { ParticlesBg } from "particles-bg-vue";

export default {
    components: {
        ParticlesBg,
        inputCsfr: Csfr,
    },

    data() {
        return {
            errors: [],
            razon: "",
            rif: "",
            tlf: "",
            email: "",
            password: "",
        };
    },

     setup() {
        const razon = ref(null);
        const rif = ref(null);
        const tlf = ref(null);
        const email = ref(null);
        const password = ref(null);

        return {
            razon,
            rif,
            tlf,
            email,
            password,

            onReset() {
                razon.value = null;
                rif.value = null;
                tlf.value = null;
                email.value = null;
                password.value = null;
            },
        };
    },

    methods: {
        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
                confirmButtonText: "Ok",
            });
        },

        registerEMP(e) {
            let data = Object.fromEntries(new FormData(e.target));
            axios
                .post("/empresas/crear", data)
                .then((res) => {
                    this.showAlert(
                        "success",
                        "Empresa creada exitosamente.",
                        "Por Favor Inicie Sesion En La Aplicacion"
                    );
                })
                .then(() => {
                    (this.razon = ""),
                        (this.rif = ""),
                        (this.tlf = ""),
                        (this.email = ""),
                        (this.password = "");
                })
                .catch((err) => {
                    console.log(err.response);
                    this.showAlert(
                        "error",
                        err.response.data.message,
                        ...Object.values(err.response.data)[0]
                    );
                });
        },
    },
};
</script>

<style scoped>
h2 {
    margin: 4px;
    padding: 4px;
}

.main {
    height: 100%;
    max-width: 80%;
    width: 80%;
    padding: 60px;
    margin: auto;
    align-self: center;
    justify-self: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.headers {
    display: inline-block;
    margin: 20px;
    padding: 20px;
    vertical-align: top;
    border: 1px solid #94f899;
}
</style>
