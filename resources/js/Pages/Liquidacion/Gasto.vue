<template>
    <div class="row">
        <div
            class="col-md-12 d-flex justify-content-between align-items-center mb-2"
        >
            <div>
                <strong><i class="fa fa-user mr-2"></i>Chofer:</strong>
                {{ chofer.nombre }}
                <p class="text-muted">DNI: {{ chofer.dni }}</p>
            </div>
            <div>
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#modal_gastos"
                    style="flex-shrink: 0"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
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
                <tr v-for="(gasto, index) in form.gastos" :key="gasto.id">
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
        <div class="col-12 d-flex justify-content-between mt-3">
            <button class="btn btn-primary" @click.prevent="anterior()">
                Anterior
            </button>
            <button class="btn btn-primary" @click.prevent="siguiente()">
                Siguiente
            </button>
        </div>
        <modal-component modal_id="modal_gastos" titulo="Anticipos">
            <div>
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
                            v-for="(gasto, index) in removedGastos"
                            :key="gasto.id"
                        >
                            <td>
                                <a
                                    @click.prevent="agregarGasto(index)"
                                    class="btn btn-sm btn-primary"
                                    ><i class="fa fa-plus"></i
                                ></a>
                            </td>
                            <td>{{ index + 1 }}</td>
                            <td>{{ gasto.fecha }}</td>
                            <td>{{ gasto.proveedor.razon_social }}</td>
                            <td>{{ gasto.flota.nombre }}</td>
                            <td>{{ gasto.importe | formatNumber }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </modal-component>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import ModalComponent from "../../components/Modal.vue";
export default {
    components: {
        ModalComponent,
    },
    methods: {
        siguiente() {
            this.$emit("siguiente");
        },
        anterior() {
            this.$emit("anterior");
        },
        quitarGasto(index) {
            this.$store.commit("REMOVE_GASTO", index);
        },
        agregarGasto(index) {
            this.$store.commit("AGREGAR_GASTO", index);
        },
    },
    computed: {
        ...mapGetters({
            form: "getForm",
            chofer: "getChofer",
            chofer_id: "getChoferId",
            removedGastos: "getRemovedGastos",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
        totalImporte() {
            return this.form.gastos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
    },
};
</script>
