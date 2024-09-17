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
            <div class="d-flex align-items-center form-group">
                <select
                    id="forma_pago_id"
                    class="form-control"
                    v-model="form_pago.forma_pago_id"
                    @change="updateFormaPagoId"
                >
                    <option value="" disabled selected>Forma de pago</option>
                    <option
                        :value="forma.id"
                        :key="index"
                        v-for="(forma, index) in forma_pagos"
                    >
                        {{ forma.descripcion }}
                    </option>
                </select>
                <button
                    class="btn btn-primary"
                    type="button"
                    data-toggle="modal"
                    data-target="#modal_formaPagos"
                    style="flex-shrink: 0"
                    :disabled="!form_pago.forma_pago_id || monto_faltante == 0"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="col-md-12">
            <p class="text-muted">
                <b>Total a pagar:</b>
                {{ form.total_liquidacion | formatNumber }}
                <br />
                <b>Monto faltante:</b>
                {{ monto_faltante | formatNumber }}
            </p>
        </div>
        <div class="w-100">
            <span v-if="errors.formaPagos" class="text-danger w-100 d-block">
                {{ getErrorMessage(errors.formaPagos) }}
            </span>
            <span
                v-if="errors.monto_faltante"
                class="text-danger w-100 d-block"
            >
                {{ getErrorMessage(errors.monto_faltante) }}
            </span>
        </div>
        <table class="table table-bordered col-md-12">
            <thead>
                <tr>
                    <th></th>
                    <th>Numero</th>
                    <th>Forma</th>
                    <th>Descripcion</th>
                    <th>Fecha emision</th>
                    <th>Fecha vencimiento</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(forma, index) in form.formaPagos" :key="index">
                    <td>
                        <a
                            @click.prevent="quitarPago(index)"
                            class="btn btn-sm btn-danger"
                            ><i class="fa fa-trash"></i
                        ></a>
                    </td>
                    <td>{{ forma.numero }}</td>
                    <td>{{ forma.abreviacion }}</td>
                    <td>{{ forma.descripcion }}</td>
                    <td>{{ forma.fecha_emision }}</td>
                    <td>{{ forma.fecha_vencimiento }}</td>
                    <td>{{ forma.importe | formatNumber }}</td>
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
                    <h5 class="text-center">
                        Monto faltante:{{ monto_faltante | formatNumber }}
                    </h5>
                </div>
                <div class="col-md-6" v-if="form_pago.forma_pago_id == 1">
                    <label for="banco_id">Bancos</label>
                    <select
                        id="banco_id"
                        class="form-control"
                        v-model="form_pago.banco_id"
                    >
                        <option
                            :value="banco.id"
                            v-for="banco in bancos"
                            :key="banco.id"
                        >
                            {{ banco.descripcion }}
                        </option>
                    </select>
                    <span
                        v-if="errors['form_pago.banco_id']"
                        class="text-danger"
                    >
                        {{ getErrorMessage(errors["form_pago.banco_id"]) }}
                    </span>
                </div>

                <div
                    class="col-md-6"
                    v-if="
                        form_pago.forma_pago_id == 1 ||
                        form_pago.forma_pago_id == 2 ||
                        [3, 4, 5, 6].includes(Number(form_pago.forma_pago_id))
                    "
                >
                    <label for="importe">Importe</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="form_pago.importe"
                    />
                    <span
                        v-if="errors['form_pago.importe']"
                        class="text-danger"
                    >
                        {{ getErrorMessage(errors["form_pago.importe"]) }}
                    </span>
                </div>

                <div
                    class="col-md-6"
                    v-if="
                        form_pago.forma_pago_id == 1 ||
                        [3, 4, 5, 6].includes(Number(form_pago.forma_pago_id))
                    "
                >
                    <label for="numero">Numero</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="form_pago.numero"
                    />
                </div>

                <div
                    class="col-md-6"
                    v-if="
                        form_pago.forma_pago_id == 1 ||
                        [3, 4, 5, 6].includes(Number(form_pago.forma_pago_id))
                    "
                >
                    <label for="fecha_emision">Fecha emision</label>
                    <input
                        type="date"
                        class="form-control"
                        v-model="form_pago.fecha_emision"
                    />
                </div>

                <div class="col-md-6" v-if="form_pago.forma_pago_id == 1">
                    <label for="fecha_vencimiento">Fecha vencimiento</label>
                    <input
                        type="date"
                        class="form-control"
                        v-model="form_pago.fecha_vencimiento"
                    />
                </div>
                <div class="col-md-12 mt-3">
                    <a @click.prevent="agregarPago()" class="btn btn-primary"
                        >Agregar</a
                    >
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
        ...mapMutations("liquidaciones", [
            "ELIMINAR_FORMA_PAGO",
            "AGREGAR_FORMA_PAGO",
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
                .dispatch("liquidaciones/validarFormaPagos")
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
            this.ELIMINAR_FORMA_PAGO(index);
        },
        agregarPago() {
            const formaPagoId = this.form_pago.forma_pago_id;
            const bancoId = this.form_pago.banco_id;
            const forma = this.forma_pagos.find(
                (forma) => forma.id == formaPagoId
            );
            this.form_pago.abreviacion = forma.abreviacion;
            if (formaPagoId == 1) {
                const banco = this.bancos.find((banco) => banco.id == bancoId);
                this.form_pago.descripcion = banco.descripcion;
            } else {
                this.form_pago.descripcion = forma.descripcion;
            }

            this.$store
                .dispatch("liquidaciones/validarFormaPago", this.form_pago)
                .then(() => {
                    $("#modal_formaPagos").modal("hide");
                    this.$toast.open({
                        message: "Forma de pago agregada exitosamente!",
                        type: "success",
                        position: "top-right",
                        duration: 2000,
                    });
                })
                .catch((err) => {
                    console.log(err);
                    this.$toast.open({
                        message:
                            "Error al validar la forma de pago. Corrija los errores!",
                        type: "error",
                        position: "top-right",
                        duration: 2000,
                    });
                });
        },
    },
    computed: {
        ...mapState("liquidaciones", {
            form: (state) => state.form,
            chofer: (state) => state.chofer,
            errors: (state) => state.errors,
            form_pago: (state) => state.form_pago,
            monto_faltante: (state) => state.monto_faltante,
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
