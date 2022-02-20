<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manejo De Cargos</h3>
                        <div class="card-tools d-flex align-items-center">
                            <button
                                class="
                                    btn btn-success
                                    d-flex
                                    align-items-center
                                "
                                v-on:click.prevent="addCargo()"
                            >
                                <span
                                    class="d-none d-sm-block mr-2"
                                    style="color: white"
                                    >Añadir Nuevo Cargo</span
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
                                    <th>Creado En</th>
                                    <th>Actualizado En</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cargo in cargos" :key="cargo.id">
                                    <td>
                                        <div class="items">
                                            <button
                                                class="p-1 mx-3 btn"
                                                type="button"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Editar Este Usuario"
                                                v-on:click.prevent="
                                                    editCargo(cargo)
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
                                    <td>{{ cargo.id }}</td>
                                    <td>{{ cargo.cargo }}</td>
                                    <td>{{ formatDate(cargo.created_at) }}</td>
                                    <td>{{ formatDate(cargo.updated_at) }}</td>
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
                            Crear Un Nuevo Cargo
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
                        methodd="POST"
                        class="form-group"
                        @submit.prevent="createCargo"
                    >
                        <input-csfr />

                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="nombre">Cargo </label>
                                    <input
                                        id="cargo"
                                        name="cargo"
                                        type="text"
                                        v-model="cargo"
                                        class="form-control"
                                        placeholder="Cargo"
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
                            Actualizar Cargo
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
                        v-on:submit.prevent="updateCargo(fillCargo.id)"
                    >
                        <input-csfr />

                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label for="cargo">Cargo </label>
                                    <input
                                        id="Editcargo"
                                        name="cargo"
                                        type="text"
                                        v-model="fillCargo.cargo"
                                        class="form-control"
                                        placeholder="Cargo"
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
            cargos: [],
            render: false,
            errors: [],
            cargo: "",
            fillCargo: { id: "", cargo: "" },
        };
    },

    mounted() {
        // Simple GET request using axios
        this.getCargoList();

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
        addCargo: function () {
            $("#create").modal("show");
        },

        getCargoList: function () {
            axios.get("/cargos/lista").then((response) => {
                setTimeout(() => {
                    this.render = true;
                    this.cargos = response.data.cargos;
                    this.$nextTick(() => {
                        $("#example").DataTable();
                    });
                }, 1000);
            });
        },

        createCargo(e) {
            let data = Object.fromEntries(new FormData(e.target));
            axios
                .post("/cargo/ingresar", data)
                .then((res) => {
                    this.showAlert("success", "Cargo Creado Exitosamente.", "");
                })
                .then(() => {
                    this.$refs["closesModal"].click();
                    (this.cargo = ""), (this.render = false);
                    this.getCargoList();

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

        editCargo: function (cargo) {
            this.fillCargo.id = cargo.id;
            this.fillCargo.cargo = cargo.cargo;

            $("#edit").modal("show");
        },

        updateCargo: function (id) {
            var url = "/cargo/" + id;
            axios
                .put(url, this.fillCargo)
                .then((response) => {
                    this.render = false;
                    this.getCargoList();
                    (this.fillCargo = { id: "", cargo: "" }),
                        this.showAlert(
                            "success",
                            "Cargo Actualizado Exitosamente.",
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
