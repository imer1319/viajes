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
                    data-target="#modal_movimientos"
                    style="flex-shrink: 0"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <span v-if="errors.movimientos" class="text-danger">{{
            getErrorMessage(errors.movimientos)
        }}</span>
        <table class="table table-bordered col-md-12">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Fecha</th>
                    <th># remito</th>
                    <th>Tipo de viaje</th>
                    <th>Precio real</th>
                    <th>IVA</th>
                    <th>Saldo total</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in form.movimientos"
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
                    <td>
                        {{ movimiento.numero_factura_1 }}-{{
                            movimiento.numero_factura_2
                        }}
                    </td>
                    <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                    <td>{{ movimiento.precio_real | formatNumber }}</td>
                    <td>{{ movimiento.iva | formatNumber }}</td>
                    <td>{{ movimiento.total | formatNumber }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5"><b>Totales</b></td>
                    <td>{{ totalPrecioReal | formatNumber }}</td>
                    <td>{{ totalIva | formatNumber }}</td>
                    <td>{{ totalSaldo | formatNumber }}</td>
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
        <modal-component modal_id="modal_movimientos" titulo="Movimientos">
            <div>
                <table class="table table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Fecha</th>
                            <th># remito</th>
                            <th>Tipo de viaje</th>
                            <th>Precio real</th>
                            <th>IVA</th>
                            <th>Saldo total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(movimiento, index) in removedMovimientos"
                            :key="movimiento.id"
                        >
                            <td>
                                <a
                                    @click.prevent="agregarMovimiento(index)"
                                    class="btn btn-sm btn-primary"
                                    ><i class="fa fa-plus"></i
                                ></a>
                            </td>
                            <td>{{ index + 1 }}</td>
                            <td>{{ movimiento.fecha }}</td>
                            <td>
                                {{ movimiento.numero_factura_1 }}-{{
                                    movimiento.numero_factura_2
                                }}
                            </td>
                            <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                            <td>{{ movimiento.precio_real | formatNumber }}</td>
                            <td>{{ movimiento.iva | formatNumber }}</td>
                            <td>{{ movimiento.total | formatNumber }}</td>
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
        ...mapMutations("facturas", [
            "REMOVE_MOVIMIENTO",
            "AGREGAR_MOVIMIENTO",
        ]),
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        siguiente() {
            this.$store
                .dispatch("facturas/validarMovimientos", this.form.movimientos)
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
        quitarMovimiento(index) {
            this.REMOVE_MOVIMIENTO(index);
        },
        agregarMovimiento(index) {
            this.AGREGAR_MOVIMIENTO(index);
        },
    },
    computed: {
        ...mapState("facturas", {
            form: (state) => state.form,
            cliente: (state) => state.cliente,
            errors: (state) => state.errors,
            removedMovimientos: (state) => state.removedMovimientos,
        }),
        totalPrecioReal() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.precio_real),
                0
            );
        },
        totalIva() {
            return this.form.movimientos?.reduce(
                (total, movimiento) => total + parseFloat(movimiento.iva),
                0
            );
        },
        totalSaldo() {
            return this.form.movimientos?.reduce(
                (total, movimiento) => total + parseFloat(movimiento.total),
                0
            );
        },
    },
};
</script>
