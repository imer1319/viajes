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
                    <th></th>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Tipo de viaje</th>
                    <th>Precio chofer</th>
                    <th>%</th>
                    <th>Comision chofer</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in movimientos"
                    :key="movimiento.id"
                >
                    <td>
                        <a
                            @click.prevent="quitarMovimiento(index)"
                            class="btn btn-sm btn-danger"
                            ><i class="fa fa-trash"></i
                        ></a>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ movimiento.fecha }}</td>
                    <td>{{ movimiento.cliente.razon_social }}</td>
                    <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                    <td>{{ movimiento.precio_chofer | formatNumber }}</td>
                    <td>{{ movimiento.porcentaje_pago }}</td>
                    <td>{{ movimiento.comision_chofer | formatNumber }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Totales</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ totalPrecioChofer | formatNumber }}</td>
                    <td></td>
                    <td>{{ totalComisionChofer | formatNumber }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="col-12 d-flex justify-content-between mt-3">
            <button class="btn btn-primary" @click.prevent="anterior()">
                Anterior
            </button>
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
        anterior() {
            this.$emit("anterior");
        },
        quitarMovimiento(index) {
            this.$store.commit("REMOVE_MOVIMIENTO", index);
        },
    },
    computed: {
        ...mapGetters({
            chofer: "getChofer",
            movimientos: "getMovimientos",
        }),
        totalPrecioChofer() {
            return this.movimientos.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.precio_chofer),
                0
            );
        },
        totalComisionChofer() {
            return this.movimientos.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.comision_chofer),
                0
            );
        },
    },
};
</script>
