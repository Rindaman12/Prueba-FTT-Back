<template>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manejo De Usuarios</h3>
            <div class="card-tools d-flex align-items-center">
              <button
                class="btn btn-success d-flex align-items-center"
                v-on:click.prevent="addUser()"
              >
                <span class="d-none d-sm-block mr-2" style="color: white"
                  >Añadir Nuevo Usuario</span
                ><i class="fas fa-user-plus fa-fw" style="color: white"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div v-if="render" class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered" id="example">
              <thead>
                <tr>
                  <th>Modificar</th>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Creado En</th>
                  <th>Actualizado En</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>
                    <div class="items">
                        
                      <button
                        class="p-1 mx-3 btn"
                        type="button"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Editar Este Usuario"
                        v-on:click.prevent="editUser(user)"
                      >
                        <i class="fas fa-edit nav-icon blue"></i>
                      </button>
                    </div>
                  </td>
                  <td>{{ user.id }}</td>
                  <td>{{ user.nombre }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ formatDate(user.created_at) }}</td>
                  <td>{{ formatDate(user.updated_at) }}</td>
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
            <h5 class="modal-title" id="editLabel">Crear Un Nuevo Usuario</h5>
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

          <form methodd="POST" class="form-group" @submit.prevent="createUser">
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
                  <label for="password">Contraseña</label>
                  <input
                    id="password"
                    name="password"
                    type="password"
                    v-model="password"
                    class="form-control"
                    placeholder="Contraseña"
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
            <h5 class="modal-title" id="editLabel">Actualizar Usuario</h5>
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

          <form method="PUT" v-on:submit.prevent="updateUser(fillUser.id)">
            <input-csfr />

            <div class="modal-body">
              <div class="form-group">
                <div class="mb-3">
                  <label for="username">Nombre </label>
                  <input
                    id="Editnombre"
                    name="nombre"
                    type="text"
                    v-model="fillUser.nombre"
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
                    id="Editemail"
                    name="email"
                    type="email"
                    v-model="fillUser.email"
                    class="form-control"
                    placeholder="Email"
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
      users: [],
      render: false,
      errors: [],
      nombre: "",
      email: "",
      password: "",
      fillUser: { id: "", nombre: "", email: ""}
    };
  },

  mounted() {
    // Simple GET request using axios
    this.getUserList();

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
    addUser: function () {
      $("#create").modal("show");
    },

    getUserList: function () {
      axios.get("/usuarios/lista").then((response) => {
        setTimeout(() => {
          this.render = true;
          this.users = response.data.users;
          this.$nextTick(() => {
            $("#example").DataTable();
          });
        }, 1000);
      });
    },

    createUser(e) {
      let data = Object.fromEntries(new FormData(e.target));
      axios
        .post("/usuario/ingresar", data)
        .then((res) => {
          this.showAlert("success", "Usuario Creado Exitosamente.", "");
        })
        .then(() => {
          this.$refs["closesModal"].click();
          (this.nombre = ""),
            (this.email = ""),
            (this.password = ""),
            (this.render = false);
          this.getUserList();

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

    editUser: function (user) {
      this.fillUser.id = user.id;
      this.fillUser.nombre = user.nombre;
      this.fillUser.email = user.email;

      $("#edit").modal("show");
    },

    updateUser: function (id) {
      var url = "/usuario/" + id;
      axios
        .put(url, this.fillUser)
        .then((response) => {
          this.render = false;
          this.getUserList();
          (this.fillUser = { id: "", nombre: "", email: ""}),
            this.showAlert("success", "Usuario Actualizado Exitosamente.", "");
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
