<template>
    <div class="row">
        <div
            class="col-md-12 d-flex justify-content-between align-items-center mb-2"
        >
            <div>
                <strong><i class="fa fa-user mr-2"></i>Cliente:</strong>
                {{ cliente.razon_social }}
                <p class="text-muted"><b>CUIT:</b> {{ cliente.cuit }}</p>
                <p class="text-muted">
                    <b>Total a pagar:</b> {{ form.total_pagado }}
                </p>
            </div>
            <div>
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#modal_formaPagos"
                    style="flex-shrink: 0"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <span v-if="errors.formaPagos" class="text-danger">{{
            getErrorMessage(errors.formaPagos)
        }}</span>
        <table class="table table-bordered col-md-12">
            <thead>
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>Forma</th>
                    <th>Descripcion</th>
                    <th>Fecha emision</th>
                    <th>Fecha vencimiento</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(movimiento, index) in form.formaPagos"
                    :key="movimiento.id"
                >
                    <td>
                        <a
                            @click.prevent="quitarPago(index)"
                            class="btn btn-sm btn-danger"
                            ><i class="fa fa-trash"></i
                        ></a>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ movimiento.fecha }}</td>
                    <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                    <td>{{ movimiento.iva }}</td>
                    <td>{{ movimiento.total }}</td>
                    <td>{{ movimiento.precio_real }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><b>Totales</b></td>
                    <td>{{ totalImportePagos | formatNumber }}</td>
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
        <modal-component modal_id="modal_formaPagos" titulo="Formas de pago">
            <div class="row">
                <div class="col-12">
                    <label for="forma_pago_id">Forma de pago</label>
                    <select
                        id="forma_pago_id"
                        class="form-control"
                        v-model="form_pago.forma_pago_id"
                        @change="updateFormaPagoId"
                    >
                        <option :value="forma.id" v-for="forma in forma_pagos">
                            {{ forma.descripcion }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="banco_id">Bancos</label>
                    <select
                        id="banco_id"
                        class="form-control"
                        v-model="form_pago.banco_id"
                    >
                        <option :value="banco.id" v-for="banco in bancos">
                            {{ banco.descripcion }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="importe">Importe</label>
                    <input type="text" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="numero">Numero</label>
                    <input type="text" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="f_emision">Fecha emision</label>
                    <input type="date" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="f_vencimiento">Fecha vencimiento</label>
                    <input type="date" class="form-control" />
                </div>
            </div>
        </modal-component>
    </div>
</template>
<script>
import { mapState } from "vuex";
import ModalComponent from "../../components/Modal.vue";
import { mapMutations } from "vuex";
export default {
    props: ["bancos", "forma_pagos"],
    components: {
        ModalComponent,
    },
    methods: {
        ...mapMutations("recibos", [
            "REMOVE_PAGO",
            "AGREGAR_PAGO",
            "SET_PAGO_FORMA_PAGO_ID",
        ]),
        updateFormaPagoId(event) {
            this.SET_PAGO_FORMA_PAGO_ID(event.target.value);
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        siguiente() {
            this.$store
                .dispatch("recibos/validarPagos", this.form.formaPagos)
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
        quitarPago(index) {
            this.REMOVE_PAGO(index);
        },
        agregarPago(index) {
            this.AGREGAR_PAGO(index);
        },
    },
    computed: {
        ...mapState("recibos", {
            form: (state) => state.form,
            cliente: (state) => state.cliente,
            errors: (state) => state.errors,
            form_pago: (state) => state.form_pago,
        }),
        totalImportePagos() {
            return this.form.formaPagos?.reduce(
                (total, forma) => total + parseFloat(forma.importe),
                0
            );
        },
    },
};
</script>
