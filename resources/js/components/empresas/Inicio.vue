<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <div v-if="!buscar">
                <q-card-section class="q-pt-none">
                    <h2 class="header">Crear Postulacion</h2>
                </q-card-section>
                <q-separator inset />

                <q-card-section class="q-pt-none">
                    <form
                        method="POST"
                        class="form-group"
                        @submit.prevent="crearPostulacion"
                    >
                        <input-csfr />
                        <div class="search row g-3">
                            <div class="col-sm-5">
                                <select
                                    v-model="defaultCargo"
                                    class="
                                        btn btn-primary
                                        w-100
                                        dropdown-toggle
                                    "
                                    name="cargo_id"
                                    id="cargo_id"
                                >
                                    <option disabled value="">
                                        Por Favor Seleccione Una Opcion
                                    </option>
                                    <option
                                        v-for="cargo in cargos"
                                        :key="cargo.value"
                                        :value="cargo.value"
                                    >
                                        {{ cargo.car }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <input
                                    name="anos"
                                    type="number"
                                    placeholder="Años De Exp"
                                    min="1"
                                    max="25"
                                    class="form-control"
                                    v-model="anos"
                                    required
                                />
                            </div>
                            <div class="col-sm">
                                <button class="btn btn-primary" type="submit">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center">
                        <button
                            class="btn btn-primary"
                            @click="buscarBoton()"
                        >
                            Mostrar Lista Personal
                        </button>
                    </div>
                </q-card-section>
            </div>

            <div v-else>
                <q-card-section class="q-pt-none">
                    <h2 class="header">Lista De Personal Existente</h2>
                </q-card-section>
                <q-separator inset />
                <q-card-section class="row justify-content-center">
                    <button class="btn btn-primary" @click="crearBoton()">
                        Crear Una Postulacion
                    </button>
                </q-card-section>

                <q-card-section class="row justify-content-center">
                    <q-card
                        v-for="personal in personals"
                        :key="personal.id"
                        class="my-card2"
                        flat
                        bordered
                    >
                        <q-card-section horizontal>
                            <q-card-section class="q-pt-xs">
                                <div class="text-overline">
                                    {{ personal.email }}
                                </div>
                                <div class="text-h5 q-mt-sm q-mb-xs">
                                    {{ personal.nombre }}
                                </div>
                                <div class="text-caption text-grey">
                                    TLF: {{ personal.tlf }}
                                </div>
                            </q-card-section>

                            <q-card-section class="col-5 flex flex-center">
                                <q-img
                                    class="rounded-borders"
                                    src="/img/personal.jpg"
                                />
                            </q-card-section>
                        </q-card-section>

                        <q-separator />
                        <q-card-section class="q-pt-xs">
                            Descripcion: {{ personal.descripcion }}
                        </q-card-section>
                        <q-separator inset />
                        <q-card-section class="q-pt-xs">
                            Años Exp: {{ personal.anos }}
                        </q-card-section>
                    </q-card>
                </q-card-section>
            </div>
        </q-card>
    </div>
</template>

<script>
import Csfr from "./Csrf";
import Swal from "sweetalert2";

export default {
    components: {
        inputCsfr: Csfr,
    },

    data() {
        return {
            errors: [],
            personals: [],
            defaultCargo: "",
            anos: "",
            cargos: {},
            buscar: false,
        };
    },

    mounted() {
        // Simple GET request using axios
        this.getCargos();
        this.buscarPersonal();
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

        getCargos(e) {
            // Simple GET request using axios
            axios.get("/empresas/cargos").then((response) => {
                let cargo = response.data.cargos.map((s) => {
                    let arr = {};
                    arr.value = s.id;
                    arr.car = s.cargo;
                    return arr;
                });
                this.cargos = cargo;
            });
        },

        crearPostulacion(e) {
            let data = Object.fromEntries(new FormData(e.target));
            axios
                .post("/postulacion/ingresar", data)
                .then((res) => {
                    this.showAlert(
                        "success",
                        "Postulacion Creada Exitosamente.",
                        ""
                    );
                })
                .then(() => {
                    this.$nextTick(() => {
                        this.buscar = true;
                    });
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

        buscarPersonal: function () {
            axios.get("/personal/buscar").then((response) => {
                this.personals = response.data.personals;
            });
        },

        crearBoton() {
            this.$nextTick(() => {
                this.buscar = false;
            });
        },

        buscarBoton() {
            this.$nextTick(() => {
                this.buscar = true;
            });
        },

        exit() {
            this.errors = [];
        },
    },
};
</script>

<style scoped>
.header {
    margin-top: 2%;
    margin-bottom: 2%;
}

.search {
    margin-top: 2%;
    margin-bottom: 2%;
}

.my-card2 {
    width: 100%;
    max-width: 400px;
    margin: auto;
    margin-top: 2%;
}
</style>
