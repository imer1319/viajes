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
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Tipo de viaje</th>
                    <th>Precio real</th>
                    <th>Total</th>
                    <th>Flota</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in chofer.movimientos"
                    :key="movimiento.id"
                >
                    <td>{{ index + 1 }}</td>
                    <td>{{ movimiento.fecha }}</td>
                    <td>{{ movimiento.cliente.razon_social }}</td>
                    <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                    <td>{{ movimiento.precio_real }}</td>
                    <td>{{ movimiento.total }}</td>
                    <td>{{ movimiento.flota.nombre }}</td>
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
