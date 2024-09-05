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
                            label="descripcion"
                            @input="handleInput"
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
                        >
                            <template
                                #no-options="{ search, searching, loading }"
                            >
                                No se encontraron tipos de pago
                            </template>
                        </v-select>
                    </div>
                </div>
                <span v-if="errors.tipo_gastos" class="text-danger">{{
                    getErrorMessage(errors.tipo_gastos)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="actualizarGasto"
                >
                    Actualizar
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
import ModalComponent from "../../components/Modal.vue";
import ProveedorCreate from "../../Pages/Proveedor/Create.vue";
import ProveedorTable from "../../Pages/Proveedor/Table.vue";
import FlotaCreate from "../../Pages/Flota/Create.vue";
import FlotaTable from "../../Pages/Flota/Table.vue";
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
    props: [
        "numero_interno",
        "chofer_id",
        "redirect",
        "gasto",
        "tipo_gastos_data",
    ],
    created() {
        if (this.gasto) {
            this.setFormValues(this.gasto);
        }
        if (this.chofer_id) {
            this.form.chofer_id = this.chofer_id;
        }
    },
    data() {
        return {
            form: {
                numero_interno: "",
                fecha: "",
                chofer_id: "",
                proveedor_id: "",
                flota_id: "",
                importe: "",
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
        actualizarGasto() {
            this.form.saldo = this.form.importe;
            this.$store
                .dispatch("actualizarGasto", this.form)
                .then(() => {
                    if (this.redirect) {
                        window.location = `/gastos`;
                        return;
                    }
                    this.resetForm();
                    this.$toast.open({
                        message: "Gasto editado exitosamente!",
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
        handleInput(selectedItems) {
            this.form.tipo_gastos = selectedItems.filter(
                (item, index, self) =>
                    index ===
                    self.findIndex((t) => t.descripcion === item.descripcion)
            );
        },
        resetForm() {
            this.form = {
                id: "",
                numero_interno: "",
                fecha: "",
                chofer_id: "",
                flota_id: "",
                proveedor_id: "",
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
        setFormValues(gasto) {
            this.form.id = gasto.id;
            this.form.numero_interno = gasto.numero_interno;
            this.form.fecha = gasto.fecha;
            this.form.chofer_id = gasto.chofer_id;
            this.form.flota_id = gasto.flota_id;
            this.form.proveedor_id = gasto.proveedor_id;
            this.form.importe = gasto.importe;
            this.form.saldo = gasto.saldo;
            this.form.detalle = gasto.detalle;
            this.form.tipo_gastos = gasto.tipo_gastos.map((tipo) => ({
                id: tipo.id,
                descripcion: tipo.descripcion,
            }));
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
