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
        <span v-if="errors.gastos" class="text-danger">{{
            getErrorMessage(errors.gastos)
        }}</span>
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
                    <td>{{ totalGasto | formatNumber }}</td>
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
import { mapMutations, mapState } from "vuex";
import ModalComponent from "../../components/Modal.vue";
export default {
    components: {
        ModalComponent,
    },
    methods: {
        ...mapMutations("liquidaciones", [
            "REMOVE_GASTO",
            "AGREGAR_GASTO",
            "SET_MONTO_FALTANTE",
        ]),
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        siguiente() {
            this.form.total_liquidacion = this.totalLiquidacion;
            this.SET_MONTO_FALTANTE(this.totalLiquidacion);
            this.$store
                .dispatch("liquidaciones/validarGastos", this.form.gastos)
                .then(() => {
                    this.$emit("siguiente");
                    this.$toast.open({
                        message: "Datos validados exitosamente!",
                        type: "success",
                        position: "top-right",
                        duration: 2000,
                    });
                })
                .catch(() => {
                    this.$toast.open({
                        message: "Corrija los siguientes errores!",
                        type: "error",
                        position: "top-right",
                        duration: 2000,
                    });
                });
        },
        anterior() {
            this.$emit("anterior");
        },
        quitarGasto(index) {
            this.REMOVE_GASTO(index);
        },
        agregarGasto(index) {
            this.AGREGAR_GASTO(index);
        },
    },
    computed: {
        ...mapState("liquidaciones", {
            form: (state) => state.form,
            chofer: (state) => state.chofer,
            removedGastos: (state) => state.removedGastos,
            isEditing: (state) => state.isEditing,
            errors: (state) => state.errors,
        }),
        totalGasto() {
            return this.form.gastos?.reduce((total, gasto) => {
                return total + parseFloat(gasto.importe);
            }, 0);
        },
        totalAnticipo() {
            return this.form.anticipos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
        totalMovimientos() {
            return this.form.movimientos?.reduce((total, movimiento) => {
                return total + parseFloat(movimiento.comision_chofer);
            }, 0);
        },
        totalLiquidacion() {
            return this.totalMovimientos - this.totalAnticipo + this.totalGasto;
        },
    },
};
</script>
