<template>
    <div class="row">
        <div class="col-6">
            <label for="numero_factura">Numero de factura</label>
            <div class="row">
                <div class="col-md-4">
                    <input
                        type="text"
                        v-model="form.numero_factura_1"
                        class="form-control text-right"
                        id="numero_factura_1"
                        @input="handleInput($event, 4)"
                        @blur="handleBlur($event, 4)"
                    />
                    <span v-if="errors.numero_factura_1" class="text-danger">{{
                        getErrorMessage(errors.numero_factura_1)
                    }}</span>
                </div>
                <div class="col-md-8">
                    <input
                        type="text"
                        v-model="form.numero_factura_2"
                        class="form-control text-right"
                        id="numero_factura_2"
                        @input="handleInput($event, 8)"
                        @blur="handleBlur($event, 8)"
                    />
                    <span v-if="errors.numero_factura_2" class="text-danger">{{
                        getErrorMessage(errors.numero_factura_2)
                    }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" v-model="form.fecha" />
            <span v-if="errors.fecha" class="text-danger">{{
                getErrorMessage(errors.fecha)
            }}</span>
        </div>
        <div class="col-md-6">
            <label for="cliente_id">Cliente</label>
            <div class="d-flex w-100">
                <div class="flex-grow-1">
                    <v-select
                        :options="clientes"
                        v-model="form.cliente_id"
                        :reduce="(cliente) => cliente.id"
                        label="razon_social"
                    ></v-select>
                </div>
                <button
                    class="btn btn-primary ml-2"
                    type="button"
                    data-toggle="modal"
                    data-target="#modal_cliente"
                    style="flex-shrink: 0"
                >
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <span v-if="errors.cliente_id" class="text-danger">{{
                getErrorMessage(errors.cliente_id)
            }}</span>
        </div>
        <div class="col-6">
            <label for="condiciones_pago_id">Condicion de venta</label>
            <div class="d-flex w-100">
                <div class="flex-grow-1">
                    <v-select
                        :options="condiciones_pago_data"
                        v-model="form.condiciones_pago_id"
                        :reduce="(condicion) => condicion.id"
                        label="condicion"
                    ></v-select>
                </div>
            </div>
            <span v-if="errors.condiciones_pago_id" class="text-danger">{{
                getErrorMessage(errors.condiciones_pago_id)
            }}</span>
        </div>
        <div class="col-md-12">
            <label for="observaciones">Observaciones</label>
            <textarea
                id="observaciones"
                class="form-control"
                rows="2"
                v-model="form.observaciones"
            ></textarea>
            <span v-if="errors.observaciones" class="text-danger">{{
                getErrorMessage(errors.observaciones)
            }}</span>
        </div>
        <div class="col-12 d-flex justify-content-end mt-3">
            <button class="btn btn-primary" @click.prevent="validarHead()">
                Siguiente
            </button>
        </div>
        <!-- Cliente -->
        <modal-component modal_id="modal_cliente" titulo="Clientees">
            <cliente-create
                :condiciones_iva="condiciones_iva_data"
                :provincias="provincias_data"
                :retencion_ganancias="retencion_ganancias_data"
                :retencion_ingresos_bruto="retencion_ingresos_bruto_data"
                :tipo_documentos="tipo_documentos_data"
            ></cliente-create>
            <hr />
            <cliente-table
                @clienteSelected="updateClienteId"
                :clientes="clientes"
            ></cliente-table>
        </modal-component>
    </div>
</template>
<script>
import ClienteCreate from "../../Pages/Cliente/Create.vue";
import ClienteTable from "../../Pages/Cliente/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapState, mapMutations } from "vuex";

export default {
    props: [
        "numero_interno",
        "condiciones_iva_data",
        "provincias_data",
        "retencion_ganancias_data",
        "retencion_ingresos_bruto_data",
        "tipo_documentos_data",
        "condiciones_pago_data",
    ],
    components: {
        ClienteCreate,
        ClienteTable,
        ModalComponent,
    },
    mounted() {
        this.updateFecha();
    },
    watch: {
        "form.cliente_id": function (newVal) {
            this.$nextTick(() => {
                $("#cliente_id").val(newVal).trigger("change");
            });
        },
    },
    methods: {
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        ...mapMutations("facturas", ["SET_FORM_FECHA", "SET_FORM_CLIENTE_ID"]),
        validarHead() {
            this.$store
                .dispatch("facturas/validarHead", this.form)
                .then(() => {
                    this.$store.dispatch(
                        "facturas/getMovimientosCliente",
                        this.form.cliente_id
                    );
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
        updateFecha() {
            const today = this.getTodayDate();
            this.SET_FORM_FECHA(today);
        },
        getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, "0");
            const day = String(today.getDate()).padStart(2, "0");
            return `${year}-${month}-${day}`;
        },
        updateClienteId(cliente_id) {
            this.SET_FORM_CLIENTE_ID(cliente_id);
            $("#modal_cliente").modal("hide");
        },
        padLeftZeros(value, length) {
            return value.toString().padStart(length, "0");
        },
        handleInput(event, maxLength) {
            let value = event.target.value.replace(/\D/g, "");
            if (value.length > maxLength) {
                value = value.substring(0, maxLength);
            }
            event.target.value = value;
            this.updateValue(event.target.id, value);
        },
        handleBlur(event, maxLength) {
            let value = event.target.value;
            value = this.padLeftZeros(value, maxLength);
            event.target.value = value;
            this.updateValue(event.target.id, value);
        },
        updateValue(id, value) {
            if (id === "numero_factura_1") {
                this.form.numero_factura_1 = value;
            } else if (id === "numero_factura_2") {
                this.form.numero_factura_2 = value;
            }
        },
    },
    computed: {
        ...mapState("facturas", {
            form: (state) => state.form,
            errors: (state) => state.errors,
            clientes: (state) => state.clientes,
        }),
    },
};
</script>
