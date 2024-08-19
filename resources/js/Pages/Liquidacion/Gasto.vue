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
                    <th>Proveedor</th>
                    <th>Flota</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(gasto, index) in gastos"
                    :key="gasto.id"
                >
                    <td>
                        <a
                            @click.prevent="quitarGasto(index)"
                            class="btn btn-sm btn-danger"
                            ><i class="fa fa-trash"></i
                        ></a>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ gasto.fecha }}</td>
                    <td>{{ gasto.proveedor.razon_social }}</td>
                    <td>{{ gasto.flota.nombre }}</td>
                    <td>{{ gasto.importe | formatNumber }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Totales</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ totalImporte | formatNumber }}</td>
                </tr>
            </tfoot>
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
        quitarGasto(index) {
            this.$store.commit("REMOVE_GASTO", index);
        },
    },
    computed: {
        ...mapGetters({
            gastos: "getGastos",
            chofer: "getChofer",
            chofer_id: "getChoferId",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
        totalImporte() {
            return this.gastos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
    },
};
</script>
