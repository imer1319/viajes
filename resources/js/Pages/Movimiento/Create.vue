<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <label for="numero_interno">Numero interno</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.numero_interno"
                    disabled
                />
                <span v-if="errors.numero_interno" class="text-danger">{{
                    getErrorMessage(errors.numero_interno)
                }}</span>
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
                <div v-if="errors.cliente_id" class="text-danger d-block">
                    {{ getErrorMessage(errors.cliente_id) }}
                </div>
            </div>

            <div class="col-md-6">
                <label for="tipo_viaje_id">Tipo de viajes</label>
                <div class="d-flex w-100">
                    <div class="flex-grow-1">
                        <v-select
                            :options="tipoViajes"
                            v-model="form.tipo_viaje_id"
                            :reduce="(tipo) => tipo.id"
                            label="descripcion"
                        ></v-select>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#modal_tipo_viaje"
                        style="flex-shrink: 0"
                    >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <span v-if="errors.tipo_viaje_id" class="text-danger">{{
                    getErrorMessage(errors.tipo_viaje_id)
                }}</span>
            </div>

            <div class="col-md-12">
                <label for="detalle">Detalle</label>
                <textarea
                    v-model="form.detalle"
                    class="form-control"
                    rows="2"
                ></textarea>
                <span v-if="errors.detalle" class="text-danger">{{
                    getErrorMessage(errors.detalle)
                }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
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
                        <span
                            v-if="errors.numero_factura_1"
                            class="text-danger"
                            >{{
                                getErrorMessage(errors.numero_factura_1)
                            }}</span
                        >
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
                        <span
                            v-if="errors.numero_factura_2"
                            class="text-danger"
                            >{{
                                getErrorMessage(errors.numero_factura_2)
                            }}</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="precio_real">Precio real</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.precio_real"
                    id="precio_real"
                />
                <span v-if="errors.precio_real" class="text-danger">{{
                    getErrorMessage(errors.precio_real)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="iva">IVA</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.iva"
                    readonly
                    id="iva"
                />
                <span v-if="errors.iva" class="text-danger">{{
                    getErrorMessage(errors.iva)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="total">Total</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.total"
                    readonly
                    id="total"
                />
                <span v-if="errors.total" class="text-danger">{{
                    getErrorMessage(errors.total)
                }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="flota_id">Flota</label>
                <div class="d-flex w-100">
                    <div class="flex-grow-1">
                        <v-select
                            :options="flotas"
                            v-model="form.flota_id"
                            :reduce="(flota) => flota.id"
                            label="nombre"
                        ></v-select>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#modal_flota"
                        style="flex-shrink: 0"
                    >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <span v-if="errors.flota_id" class="text-danger">{{
                    getErrorMessage(errors.flota_id)
                }}</span>
            </div>
            <div class="col-md-6">
                <label for="chofer_id">Chofer</label>
                <div class="d-flex w-100">
                    <div class="flex-grow-1">
                        <v-select
                            :options="choferes"
                            v-model="form.chofer_id"
                            :reduce="(chofer) => chofer.id"
                            label="nombre"
                        ></v-select>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#modal_chofer"
                        style="flex-shrink: 0"
                    >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <span v-if="errors.chofer_id" class="text-danger">{{
                    getErrorMessage(errors.chofer_id)
                }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="precio_chofer">Precio Chofer</label>
                <input
                    type="number"
                    class="form-control"
                    step="0.1"
                    v-model="form.precio_chofer"
                    id="precio_chofer"
                />
                <span v-if="errors.precio_chofer" class="text-danger">{{
                    getErrorMessage(errors.precio_chofer)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="porcentaje_pago">Porcentaje Pago</label>
                <input
                    type="number"
                    class="form-control"
                    v-model="form.porcentaje_pago"
                    id="porcentaje_pago"
                />
                <span v-if="errors.porcentaje_pago" class="text-danger">{{
                    getErrorMessage(errors.porcentaje_pago)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="comision_chofer">Comision Chofer</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="form.comision_chofer"
                    readonly
                    id="comision_chofer"
                />
                <span v-if="errors.comision_chofer" class="text-danger">{{
                    getErrorMessage(errors.comision_chofer)
                }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col mt-3">
                <button
                    class="btn btn-primary"
                    @click.prevent="agregarMovimiento"
                >
                    Guardar
                </button>
            </div>
        </div>
        <!-- Chofer -->
        <modal-component modal_id="modal_chofer" titulo="Choferes">
            <chofer-create></chofer-create>
            <hr />
            <chofer-table @choferSelected="updateChoferId"></chofer-table>
        </modal-component>
        <!-- Flota -->
        <modal-component modal_id="modal_flota" titulo="Flotas">
            <flota-create></flota-create>
            <hr />
            <flota-table @flotaSelected="updateFlotaId"></flota-table>
        </modal-component>
        <!-- Cliente -->
        <modal-component modal_id="modal_cliente" titulo="Clientes">
            <cliente-create></cliente-create>
            <hr />
            <cliente-table @clienteSelected="updateClienteId"></cliente-table>
        </modal-component>
        <!-- Tipo de viaje -->
        <modal-component modal_id="modal_tipo_viaje" titulo="Tipos de viaje">
            <tipo-viaje-create></tipo-viaje-create>
            <hr />
            <tipo-viaje-table
                @tipoSelected="updateTipoViajeId"
            ></tipo-viaje-table>
        </modal-component>
    </div>
</template>
<script>
import ChoferCreate from "../../Pages/Chofer/Create.vue";
import ChoferTable from "../../Pages/Chofer/Table.vue";
import ClienteCreate from "../../Pages/Cliente/Create.vue";
import ClienteTable from "../../Pages/Cliente/Table.vue";
import FlotaCreate from "../../Pages/Flota/Create.vue";
import FlotaTable from "../../Pages/Flota/Table.vue";
import TipoViajeCreate from "../../Pages/TipoViaje/Create.vue";
import TipoViajeTable from "../../Pages/TipoViaje/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        ChoferCreate,
        ChoferTable,
        ClienteCreate,
        ClienteTable,
        FlotaCreate,
        FlotaTable,
        TipoViajeCreate,
        TipoViajeTable,
        ModalComponent,
    },
    props: ["numero_interno"],
    mounted() {
        this.form.fecha = this.getTodayDate();
        this.form.numero_interno = this.numero_interno;
    },
    data() {
        return {
            form: {
                numero_interno: "",
                fecha: "",
                cliente_id: "",
                tipo_viaje_id: "",
                detalle: "",
                numero_factura_1: "",
                numero_factura_2: "",
                precio_real: "",
                iva: 0,
                total: 0,
                saldo_total: 0,
                flota_id: "",
                chofer_id: "",
                precio_chofer: "",
                porcentaje_pago: 16,
                comision_chofer: 0,
                saldo_comision_chofer: 0,
            },
        };
    },
    computed: {
        ...mapGetters({
            choferes: "getChoferes",
            flotas: "getFlotas",
            clientes: "getClientes",
            tipoViajes: "getTipoViajes",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
    },
    watch: {
        "form.precio_real": function (newVal) {
            this.form.iva = (newVal * 0.21).toFixed(2);
            this.form.total = (
                parseFloat(newVal) + parseFloat(this.form.iva)
            ).toFixed(2);
        },
        "form.precio_chofer": function (newVal) {
            this.form.comision_chofer = (
                newVal *
                (this.form.porcentaje_pago / 100)
            ).toFixed(2);
        },
        "form.chofer_id": function (newVal) {
            this.$nextTick(() => {
                $("#chofer_id").val(newVal).trigger("change");
            });
        },
        "form.flota_id": function (newVal) {
            this.$nextTick(() => {
                $("#flota_id").val(newVal).trigger("change");
            });
        },
        "form.cliente_id": function (newVal) {
            this.$nextTick(() => {
                $("#cliente_id").val(newVal).trigger("change");
            });
        },
        "form.tipo_viaje_id": function (newVal) {
            this.$nextTick(() => {
                $("#tipo_viaje_id").val(newVal).trigger("change");
            });
        },
    },
    methods: {
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        agregarMovimiento() {
            this.form.saldo_total = this.form.total;
            this.form.saldo_comision_chofer = this.form.comision_chofer;
            this.$store
                .dispatch("agregarMovimiento", this.form)
                .then(() => {
                    this.resetForm();
                    this.$toast.open({
                        message: "Movimiento agregado exitosamente!",
                        type: "success",
                        position: "top-right",
                    });
                    window.location = "/movimientos";
                })
                .catch(() => {
                    this.$toast.open({
                        message: "Corrija los siguientes errores!",
                        type: "error",
                        position: "top-right",
                    });
                });
        },
        resetForm() {
            this.form = {
                numero_interno: "",
                fecha: "",
                cliente_id: "",
                tipo_viaje_id: "",
                detalle: "",
                numero_factura_1: "",
                numero_factura_2: "",
                precio_real: "",
                iva: 0,
                total: 0,
                saldo_total: 0,
                flota_id: "",
                chofer_id: "",
                precio_chofer: "",
                porcentaje_pago: 16,
                comision_chofer: 0,
                saldo_comision_chofer: 0,
            };
        },
        updateChoferId(chofer_id) {
            this.form.chofer_id = chofer_id;
            $("#modal_chofer").modal("hide");
        },
        updateClienteId(cliente_id) {
            this.form.cliente_id = cliente_id;
            $("#modal_cliente").modal("hide");
        },
        updateFlotaId(flota_id) {
            this.form.flota_id = flota_id;
            $("#modal_flota").modal("hide");
        },
        updateTipoViajeId(tipo_viaje_id) {
            this.form.tipo_viaje_id = tipo_viaje_id;
            $("#modal_tipo_viaje").modal("hide");
        },
        getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, "0"); // Enero es 0
            const day = String(today.getDate()).padStart(2, "0");
            return `${year}-${month}-${day}`;
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
};
</script>
