<template>
    <div class="main">
        <div class="headers bg-dark">
            <h2 class="text-green" style="font-weight: bold">
                FAST TRACK TALENT
            </h2>
            <h3 class="text-white">
                Llevandote Mas Cerca Al Talento De Verdad
            </h3>
            <h5>
                FAST TRACK TALENT, la compañia por defecto para buscar empleo y
                contratar talento de trabajo remoto a nivel nacional e
                internacional, ya esta disponible. La red de emprendimiento que
                consolida un portafolio de 48 empresas y 94 emprendedores en el
                país.
            </h5>

            <div>
                <q-btn class="buttons" color="primary" size="24px">
                    <router-link to="/loginEmp">
                        <i
                            class="fas fa-building"
                            style="padding-right: 10px"
                        ></i>

                        Login Empresa
                    </router-link>
                </q-btn>

                <q-btn class="buttons" color="secondary" size="24px">
                    <router-link to="/loginUser">
                        <i
                            class="far fa-address-card"
                            style="padding-right: 10px"
                        ></i>

                        Login Usuarios
                    </router-link>
                </q-btn>
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

export default {
    components: {
        ParticlesBg,
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

.buttons {
    margin: 60px;
}
</style>
