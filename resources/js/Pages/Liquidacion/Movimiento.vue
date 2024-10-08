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
                    <th>Cliente</th>
                    <th>Tipo de viaje</th>
                    <th>Precio chofer</th>
                    <th>%</th>
                    <th>Comision chofer</th>
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
                            class="btn btn-sm btn-primary"
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
        <modal-component modal_id="modal_movimientos" titulo="Movimientos">
            <div>
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
                            <td>{{ movimiento.cliente.razon_social }}</td>
                            <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                            <td>
                                {{ movimiento.precio_chofer | formatNumber }}
                            </td>
                            <td>{{ movimiento.porcentaje_pago }}</td>
                            <td>
                                {{ movimiento.comision_chofer | formatNumber }}
                            </td>
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
        ...mapMutations("liquidaciones", [
            "REMOVE_MOVIMIENTO",
            "AGREGAR_MOVIMIENTO",
        ]),
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        siguiente() {
            this.$store
                .dispatch(
                    "liquidaciones/validarMovimientos",
                    this.form.movimientos
                )
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
        ...mapState("liquidaciones", {
            form: (state) => state.form,
            chofer: (state) => state.chofer,
            errors: (state) => state.errors,
            removedMovimientos: (state) => state.removedMovimientos,
        }),
        totalPrecioChofer() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.precio_chofer),
                0
            );
        },
        totalComisionChofer() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.comision_chofer),
                0
            );
        },
    },
};
</script>
