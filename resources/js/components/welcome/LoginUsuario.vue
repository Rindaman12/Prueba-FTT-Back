<template>
    <div class="main">
        <div class="headers bg-dark">
         <h2 class="text-green" style="font-weight: bold">
                Login Usuario
            </h2>
                  <div class="q-pa-md row items-start q-gutter-md">
                   <q-card class="my-card text-white">
                <q-form
                    @submit.prevent="login"
                    @reset="onReset"
                    class="q-gutter-md"
                >
                    <input-csfr />

                    <q-card-section class="q-pt-none">
                        <q-input
                            filled
                            v-model="email"
                            name="email"
                            label="Email"
                            hint="Coloca tu Email"
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
                        <q-input
                            filled
                            v-model="password"
                            type="password"
                            name="password"
                            label="Contraseña"
                            hint="Coloca Tu Contraseña"
                            lazy-rules
                            bottom-slots
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
import { ParticlesBg } from "particles-bg-vue";
import Swal from "sweetalert2";
import Csfr from "./Csrf";
import { ref } from "vue";

export default {
    components: {
        ParticlesBg,
        inputCsfr: Csfr,
    },

    setup() {
        const email = ref(null);
        const password = ref(null);

        return {
            email,
            password,

            onReset() {
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

        login(e) {
            let data = Object.fromEntries(new FormData(e.target));
            axios
                .post("/usuario/login", data)
                .then((res) => {
                    this.showAlert(
                        "success",
                        "Inicio De Sesion",
                        "Logueado Exitosamente"
                    );
                    location.href = "/usuarios";
                })
                .catch((err) => {
                    this.showAlert(
                        "error",
                        "Error",
                        "Revise Los Datos Por Favor."
                    );
                });
        },
      
    },
};

</script>

<style scoped>
h2,
h3 {
    margin: 4px;
    padding: 4px;
}
h5 {
    margin: 4px;
    padding: 4px;
    align-self: normal;
    justify-self: normal;
    color: rgb(228, 228, 228);
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
