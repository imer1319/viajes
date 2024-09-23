<template>
    <div>
        <h6><span class="text-danger">*</span>Obligatorio</h6>
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
                <label for="importe"
                    >Importe<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.importe"
                    :class="{ 'is-invalid': errors.importe }"
                    class="form-control"
                    id="importe"
                />
                <span v-if="errors.importe" class="text-danger">{{
                    getErrorMessage(errors.importe)
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
                            :disabled="chofer_id != null"
                        ></v-select>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#modal_chofer"
                        style="flex-shrink: 0"
                        :disabled="chofer_id != null"
                    >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <span v-if="errors.chofer_id" class="text-danger">{{
                    getErrorMessage(errors.chofer_id)
                }}</span>
            </div>
            <div class="col-md-6">
                <label for="flota_id">Proveedor</label>
                <div class="d-flex w-100">
                    <div class="flex-grow-1">
                        <v-select
                            :options="proveedores"
                            v-model="form.proveedor_id"
                            :reduce="(proveedor) => proveedor.id"
                            label="razon_social"
                        ></v-select>
                    </div>
                    <button
                        class="btn btn-primary ml-2"
                        type="button"
                        data-toggle="modal"
                        data-target="#modal_proveedor"
                        style="flex-shrink: 0"
                    >
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <span v-if="errors.proveedor_id" class="text-danger">{{
                    getErrorMessage(errors.proveedor_id)
                }}</span>
            </div>
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
            <div class="col-md-12">
                <label for="detalle"
                    >Detalle<span class="text-danger">*</span></label
                >
                <textarea
                    v-model="form.detalle"
                    :class="{ 'is-invalid': errors.detalle }"
                    class="form-control"
                    id="detalle"
                    rows="2"
                ></textarea>
                <span v-if="errors.detalle" class="text-danger">{{
                    getErrorMessage(errors.detalle)
                }}</span>
            </div>
            <div class="col-6">
                <label for="tipo_gastos">Tipo de gasto</label>
                <div class="d-flex w-100">
                    <div class="flex-grow-1">
                        <v-select
                            taggable
                            multiple
                            :options="tipo_gastos_data"
                            v-model="form.tipo_gastos"
                            :reduce="
                                (tipoGasto) => {
                                    if (typeof tipoGasto === 'string') {
                                        return {
                                            id: '',
                                            descripcion: tipoGasto,
                                        };
                                    }
                                    return {
                                        id: tipoGasto.id,
                                        descripcion: tipoGasto.descripcion,
                                    };
                                }
                            "
                            label="descripcion"
                        >
                            <template
                                #no-options="{ search, searching, loading }"
                            >
                                No se encontraron gastos
                            </template>
                        </v-select>
                    </div>
                </div>
                <span class="text-muted"
                    >Precione <b>enter</b> para agregar uno nuevo</span
                >
                <span v-if="errors.tipo_gastos" class="text-danger">{{
                    getErrorMessage(errors.tipo_gastos)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="agregarGasto"
                    :disabled="disabled"
                >
                    Agregar
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
        <!-- Proveedor -->
        <modal-component modal_id="modal_proveedor" titulo="Proveedores">
            <proveedor-create></proveedor-create>
            <hr />
            <proveedor-table
                @proveedorSelected="updateProveedorId"
            ></proveedor-table>
        </modal-component>
    </div>
</template>
<script>
import ChoferCreate from "../../Pages/Chofer/Create.vue";
import ChoferTable from "../../Pages/Chofer/Table.vue";
import ProveedorCreate from "../../Pages/Proveedor/Create.vue";
import ProveedorTable from "../../Pages/Proveedor/Table.vue";
import FlotaCreate from "../../Pages/Flota/Create.vue";
import FlotaTable from "../../Pages/Flota/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        ChoferCreate,
        ChoferTable,
        ProveedorCreate,
        ProveedorTable,
        FlotaCreate,
        FlotaTable,
        ModalComponent,
    },
    props: ["numero_interno", "chofer_id", "redirect", "tipo_gastos_data"],
    mounted() {
        this.form.fecha = this.getTodayDate();
        this.form.numero_interno = this.numero_interno;
        if (this.chofer_id) {
            this.form.chofer_id = this.chofer_id;
        }
    },
    data() {
        return {
            disabled: false,
            form: {
                numero_interno: "",
                fecha: "",
                chofer_id: "",
                importe: "",
                flota_id: "",
                proveedor_id: "",
                saldo: "",
                detalle: "",
                tipo_gastos: [],
            },
        };
    },
    watch: {
        "form.chofer_id": function (newVal) {
            this.$nextTick(() => {
                $("#chofer_id").val(newVal).trigger("change");
            });
        },
        "form.proveedor_id": function (newVal) {
            this.$nextTick(() => {
                $("#proveedor_id").val(newVal).trigger("change");
            });
        },
        "form.flota_id": function (newVal) {
            this.$nextTick(() => {
                $("#flota_id").val(newVal).trigger("change");
            });
        },
    },
    methods: {
        agregarGasto() {
            this.form.saldo = this.form.importe;
            this.$store
                .dispatch("agregarGasto", this.form)
                .then(() => {
                    this.disabled = true;
                    if (this.redirect) {
                        window.location = `/gastos`;
                        return;
                    }
                    this.resetForm();
                    this.$toast.open({
                        message: "Anticipo agregado exitosamente!",
                        type: "success",
                        position: "top-right",
                    });
                })
                .catch(() => {
                    this.$toast.open({
                        message: "Corrija los siguientes errores!",
                        type: "error",
                        position: "top-right",
                    });
                });
        },
        getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, "0"); // Enero es 0
            const day = String(today.getDate()).padStart(2, "0");
            return `${year}-${month}-${day}`;
        },
        resetForm() {
            this.form = {
                numero_interno: "",
                fecha: "",
                chofer_id: "",
                importe: "",
                saldo: "",
                detalle: "",
            };
        },
        updateChoferId(chofer_id) {
            this.form.chofer_id = chofer_id;
            $("#modal_chofer").modal("hide");
        },
        updateFlotaId(flota_id) {
            this.form.flota_id = flota_id;
            $("#modal_flota").modal("hide");
        },
        updateProveedorId(proveedor_id) {
            this.form.proveedor_id = proveedor_id;
            $("#modal_proveedor").modal("hide");
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
    },
    computed: {
        ...mapGetters({
            choferes: "getChoferes",
            proveedores: "getProveedores",
            flotas: "getFlotas",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
