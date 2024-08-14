<template>
    <div class="row">
        <div class="col-md-12 mb-2">
            <strong><i class="fa fa-user mr-2"></i>Chofer:</strong>
            {{ chofer.nombre }}
            <p class="text-muted">DNI: {{ chofer.dni }}</p>
        </div>
        <table class="table table-bordered col-md-12">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Numero interno</th>
                    <th>fecha</th>
                    <th>chofer_id</th>
                    <th>importe</th>
                    <th>saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in chofer.anticipos"
                    :key="movimiento.id"
                >
                    <td>{{ index + 1 }}</td>
                    <td>{{ movimiento.numero_interno }}</td>
                    <td>{{ movimiento.fecha }}</td>
                    <td>{{ movimiento.chofer.nombre }}</td>
                    <td>{{ movimiento.importe }}</td>
                    <td>{{ movimiento.saldo }}</td>
                </tr>
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-end mt-3">
            <button class="btn btn-primary" @click.prevent="siguiente()">
                Siguiente
            </button>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    methods: {
        siguiente() {
            this.$emit("siguiente");
        },
    },
    computed: {
        ...mapGetters({
            chofer: "getChofer",
            chofer_id: "getChoferId",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
