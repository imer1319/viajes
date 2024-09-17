<template>
    <div class="row">
        <div
            class="col-md-12 d-flex justify-content-between align-items-center mb-2"
        >
            <div>
                <strong><i class="fa fa-user mr-2"></i>Cliente:</strong>
                {{ cliente.razon_social }}
                <p class="text-muted">CUIT: {{ cliente.cuit }}</p>
            </div>
            <div>
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#modal_facturas"
                    style="flex-shrink: 0"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <span v-if="errors.facturas" class="text-danger d-block">{{
            getErrorMessage(errors.facturas)
        }}</span>
        <div
            v-for="(facturaErrors, facturaIndex) in errors"
            :key="facturaIndex"
            class="w-100"
        >
            <div
                v-for="(errors, field) in facturaErrors"
                :key="field"
                class="w-100 d-block"
            >
                <div class="text-danger">
                    {{ errors }}
                </div>
            </div>
        </div>
        <table class="table table-bordered col-md-12">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Fecha</th>
                    <th># Factura</th>
                    <th>Importe</th>
                    <th>Saldo total</th>
                    <th>Pago</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(factura, index) in form.facturas" :key="factura.id">
                    <td>
                        <a
                            @click.prevent="quitarMovimiento(index)"
                            class="btn btn-sm btn-primary"
                        >
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ factura.fecha }}</td>
                    <td>
                        {{ factura.numero_factura_1 }}-{{
                            factura.numero_factura_2
                        }}
                    </td>
                    <td>{{ factura.total }}</td>
                    <td>{{ factura.saldo_total | formatNumber }}</td>
                    <td width="150">
                        <input
                            type="text"
                            class="form-control"
                            v-model="factura.pago"
                            @input="actualizarTotalPago"
                        />
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><b>Totales</b></td>
                    <td>{{ totalImporte | formatNumber }}</td>
                    <td>{{ totalSaldoTotal | formatNumber }}</td>
                    <td>{{ totalPago | formatNumber }}</td>
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
        <modal-component modal_id="modal_facturas" titulo="Movimientos">
            <div>
                <table class="table table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th># Factura</th>
                            <th>Importe</th>
                            <th>Saldo total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(factura, index) in removedFacturas"
                            :key="factura.id"
                        >
                            <td>
                                <a
                                    @click.prevent="agregarFactura(index)"
                                    class="btn btn-sm btn-primary"
                                    ><i class="fa fa-plus"></i
                                ></a>
                            </td>
                            <td>{{ index + 1 }}</td>
                            <td>{{ factura.fecha }}</td>
                            <td>
                                {{ factura.numero_factura_1 }}-{{
                                    factura.numero_factura_2
                                }}
                            </td>
                            <td>{{ factura.total }}</td>
                            <td>{{ factura.saldo_total | formatNumber }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </modal-component>
    </div>
</template>
<script>
import { mapState } from "vuex";
import ModalComponent from "../../components/Modal.vue";
import { mapMutations } from "vuex";
export default {
    components: {
        ModalComponent,
    },
    methods: {
        ...mapMutations("recibos", [
            "REMOVE_FACTURA",
            "AGREGAR_FACTURA",
            "SET_MONTO_FALTANTE",
        ]),
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        siguiente() {
            this.form.total_recibo = this.totalPago;
            this.form.saldo_total = this.totalSaldoTotal;
            this.SET_MONTO_FALTANTE(this.totalPago);

            this.$store
                .dispatch("recibos/validarFacturas", this.form)
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
        actualizarTotalPago() {
            this.$nextTick(() => {
                this.totalPago;
            });
        },
        anterior() {
            this.$emit("anterior");
        },
        quitarMovimiento(index) {
            this.REMOVE_FACTURA(index);
        },
        agregarFactura(index) {
            this.AGREGAR_FACTURA(index);
        },
    },
    computed: {
        ...mapState("recibos", {
            form: (state) => state.form,
            cliente: (state) => state.cliente,
            errors: (state) => state.errors,
            removedFacturas: (state) => state.removedFacturas,
            monto_faltante: (state) => state.monto_faltante,
        }),
        hasFacturaErrors() {
            return Object.keys(this.errors).some((key) =>
                key.includes("form.facturas")
            );
        },
        totalImporte() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.total),
                0
            );
        },
        totalSaldoTotal() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.saldo_total),
                0
            );
        },
        totalPago() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.pago || 0),
                0
            );
        },
    },
};
</script>
