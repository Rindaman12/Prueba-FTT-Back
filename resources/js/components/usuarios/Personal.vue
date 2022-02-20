<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manejo De Personal</h3>
                        <div class="card-tools d-flex align-items-center">
                            <button
                                class="
                                    btn btn-success
                                    d-flex
                                    align-items-center
                                "
                                v-on:click.prevent="addPersonal()"
                            >
                                <span
                                    class="d-none d-sm-block mr-2"
                                    style="color: white"
                                    >Añadir Nuevo Personal</span
                                ><i
                                    class="fas fa-user-plus fa-fw"
                                    style="color: white"
                                ></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div v-if="render" class="card-body table-responsive p-0">
                        <table
                            class="table table-hover table-bordered"
                            id="example"
                        >
                            <thead>
                                <tr>
                                    <th>Modificar</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Descripcion</th>
                                    <th>ID Cargo</th>
                                    <th>Años Experiencia</th>
                                    <th>Creado En</th>
                                    <th>Actualizado En</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="personal in personals"
                                    :key="personal.id"
                                >
                                    <td>
                                        <div class="items">
                                          
                                            <button
                                                class="p-1 mx-3 btn"
                                                type="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Editar Este Personal"
                                                v-on:click.prevent="
                                                    editPersonal(personal)
                                                "
                                            >
                                                <i
                                                    class="
                                                        fas
                                                        fa-edit
                                                        nav-icon
                                                        blue
                                                    "
                                                ></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>{{ personal.id }}</td>
                                    <td>{{ personal.nombre }}</td>
                                    <td>{{ personal.email }}</td>
                                    <td>{{ personal.tlf }}</td>
                                    <td>{{ personal.descripcion }}</td>
                                    <td>{{ personal.cargo_id }}</td>
                                    <td>{{ personal.anos }}</td>
                                    <td>
                                        {{ formatDate(personal.created_at) }}
                                    </td>
                                    <td>
                                        {{ formatDate(personal.updated_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="row justify-content-center">
                        <img
                            src="/img/loading.gif"
                            class="text-center sg-transition"
                            loading="lazy"
                        />
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <!-- Create Modal -->

        <div
            class="modal fade"
            id="create"
            tabindex="-1"
            aria-labelledby="editLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">
                            Crear Un Nuevo Personal
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            ref="closesModal"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form
                        method="POST"
                        class="form-group"
                        @submit.prevent="createPersonal"
                    >
                        <input-csfr />

                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="nombre">Nombre </label>
                                    <input
                                        id="nombre"
                                        name="nombre"
                                        type="text"
                                        v-model="nombre"
                                        class="form-control"
                                        placeholder="Nombre"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="email">Direccion Email </label>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        v-model="email"
                                        class="form-control"
                                        placeholder="Email"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="telefono">Telefono</label>
                                    <input
                                        id="telefono"
                                        name="tlf"
                                        v-model="tlf"
                                        class="form-control"
                                        placeholder="Telefono"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="descripcion">Descripcion</label>
                                    <input
                                        id="descripcion"
                                        name="descripcion"
                                        v-model="descripcion"
                                        type="textarea"
                                        class="form-control"
                                        placeholder="Descripcion"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="cargo_id">Cargo</label>

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
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="anos"
                                        >Años De Experiencia</label
                                    >
                                    <input
                                        name="anos"
                                        type="number"
                                        min="1"
                                        max="25"
                                        class="form-control"
                                        v-model="anos"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                    value="create"
                                    name="create"
                                >
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->

        <div
            class="modal fade"
            id="edit"
            tabindex="-1"
            aria-labelledby="editLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel">
                            Actualizar Personal
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            ref="closeModal"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form
                        method="PUT"
                        v-on:submit.prevent="updatePersonal(fillPersonal.id)"
                    >
                        <input-csfr />

                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="email">Direccion Email </label>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        v-model="fillPersonal.email"
                                        class="form-control"
                                        placeholder="Email"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="telefono">Telefono</label>
                                    <input
                                        id="telefono"
                                        name="tlf"
                                        v-model="fillPersonal.tlf"
                                        class="form-control"
                                        placeholder="Telefono"
                                        required
                                    />
                                </div>
                            </div>

                             <div class="form-group">
                                <div class="mb-3">
                                    <label for="descripcion">Descripcion</label>
                                    <input
                                        id="descripcion"
                                        name="descripcion"
                                        v-model="fillPersonal.descripcion"
                                        type="textarea"
                                        class="form-control"
                                        placeholder="Descripcion"
                                        required
                                    />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                    value="update"
                                    name="update"
                                >
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Csfr from "./Csrf";
import Swal from "sweetalert2";
import "jquery/dist/jquery.min.js";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import moment from "moment";

export default {
    components: {
        inputCsfr: Csfr,
    },

    data() {
        return {
            personals: [],
            render: false,
            errors: [],
            nombre: "",
            email: "",
            tlf: "",
            descripcion: "",
            anos: "",
            defaultCargo: "",
            cargos: {},
            fillPersonal: { id: "", email: "", tlf: "", descripcion: "" },
        };
    },

    mounted() {
        // Simple GET request using axios
        this.getPersonalList();
        this.getCargos();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
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
        addPersonal: function () {
            $("#create").modal("show");
        },

        getCargos(e) {
            // Simple GET request using axios
            axios.get("cargos/lista").then((response) => {
                let cargo = response.data.cargos.map((s) => {
                    let arr = {};
                    arr.value = s.id;
                    arr.car = s.cargo;
                    return arr;
                });
                this.cargos = cargo;
            });
        },

        getPersonalList: function () {
            axios.get("/personals/lista").then((response) => {
                setTimeout(() => {
                    this.render = true;
                    this.personals = response.data.personals;
                    this.$nextTick(() => {
                        $("#example").DataTable();
                    });
                }, 1000);
            });
        },

        createPersonal(e) {
            let data = Object.fromEntries(new FormData(e.target));
            axios
                .post("/personal/ingresar", data)
                .then((res) => {
                    this.showAlert(
                        "success",
                        "Personal Creado Exitosamente.",
                        ""
                    );
                })
                .then(() => {
                    this.$refs["closesModal"].click();
                    (this.nombre = ""),
                        (this.email = ""),
                        (this.tlf = ""),
                        (this.descripcion = ""),
                        (this.render = false);
                    this.getPersonalList();

                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip();
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

        formatDate(date) {
            return moment(date).format("MMMM Do YYYY, h:mm a");
        },

        editPersonal: function (personal) {
            this.fillPersonal.id = personal.id;
            this.fillPersonal.email = personal.email;
            this.fillPersonal.tlf = personal.tlf;
            this.fillPersonal.descripcion = personal.descripcion;
            $("#edit").modal("show");
        },

        updatePersonal: function (id) {
            var url = "/personal/" + id;
            axios
                .put(url, this.fillPersonal)
                .then((response) => {
                    this.render = false;
                    this.getPersonalList();
                    (this.fillPersonal = { id: "", email: "", tlf: "", descripcion:"" }),
                        this.showAlert(
                            "success",
                            "Personal Actualizado Exitosamente.",
                            ""
                        );
                })
                .then(() => {
                    this.$refs["closeModal"].click();
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

        exit() {
            this.errors = [];
        },
    },
};
</script>

<style scoped>
.items {
    gap: 0.5em;
    justify-content: center;
}
</style>
