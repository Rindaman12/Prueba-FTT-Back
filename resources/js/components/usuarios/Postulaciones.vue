<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista De Postulaciones</h3>
                    </div>
                    <!-- /.card-header -->
                    <div v-if="render" class="card-body table-responsive p-0">
                        <table
                            class="table table-hover table-bordered"
                            id="example"
                        >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Empresa ID</th>
                                    <th>Cargo ID</th>
                                    <th>Años Requeridos</th>
                                    <th>Creado En</th>
                                    <th>Actualizado En</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="postulacion in postulaciones"
                                    :key="postulacion.id"
                                >
                                    <td>{{ postulacion.id }}</td>
                                    <td>{{ postulacion.empresa_id }}</td>
                                    <td>{{ postulacion.cargo_id }}</td>
                                    <td>{{ postulacion.anos }}</td>
                                    <td>
                                        {{ formatDate(postulacion.created_at) }}
                                    </td>
                                    <td>
                                        {{ formatDate(postulacion.updated_at) }}
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
    </div>
</template>

<script>
import "jquery/dist/jquery.min.js";
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import moment from "moment";

export default {
    data() {
        return {
            postulaciones: [],
            render: false,
        };
    },

    mounted() {
        // Simple GET request using axios
        this.getPostulacionesList();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    },

    methods: {
        getPostulacionesList: function () {
            axios.get("/postulaciones/lista").then((response) => {
                setTimeout(() => {
                    this.render = true;
                    this.postulaciones = response.data.postulaciones;
                    this.$nextTick(() => {
                        $("#example").DataTable();
                    });
                }, 1000);
            });
        },

        formatDate(date) {
            return moment(date).format("MMMM Do YYYY, h:mm a");
        },
    },
};
</script>
