<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista De Empresas</h3>
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
                                    <th>Razon</th>
                                    <th>RIF</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Creado En</th>
                                    <th>Actualizado En</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="empresa in empresas"
                                    :key="empresa.id"
                                >
                                    <td>{{ empresa.id }}</td>
                                    <td>{{ empresa.razon }}</td>
                                    <td>{{ empresa.rif }}</td>
                                    <td>{{ empresa.tlf }}</td>
                                    <td>{{ empresa.email }}</td>

                                    <td>
                                        {{ formatDate(empresa.created_at) }}
                                    </td>
                                    <td>
                                        {{ formatDate(empresa.updated_at) }}
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
            empresas: [],
            render: false,
        };
    },

    mounted() {
        // Simple GET request using axios
        this.getEmpresasList();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    },

    methods: {
        getEmpresasList: function () {
            axios.get("/empresas/lista").then((response) => {
                setTimeout(() => {
                    this.render = true;
                    this.empresas = response.data.empresas;
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
