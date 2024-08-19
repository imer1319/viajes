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
                    <th>Numero interno</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in anticipos"
                    :key="movimiento.id"
                >
                    <td>
                        <a
                            @click.prevent="quitarAnticipo(index)"
                            class="btn btn-sm btn-danger"
                            ><i class="fa fa-trash"></i
                        ></a>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ movimiento.numero_interno }}</td>
                    <td>{{ movimiento.fecha }}</td>
                    <td>{{ movimiento.importe | formatNumber }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Totales</b></td>
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
        quitarAnticipo(index) {
            this.$store.commit("REMOVE_ANTICIPO", index);
        },
    },
    computed: {
        ...mapGetters({
            chofer: "getChofer",
            anticipos: "getAnticipos",
            chofer_id: "getChoferId",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
        totalImporte() {
            return this.anticipos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
    },
};
</script>
