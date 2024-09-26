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
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="agregarAnticipo"
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
    </div>
</template>
<script>
import ChoferCreate from "../../Pages/Chofer/Create.vue";
import ChoferTable from "../../Pages/Chofer/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapGetters } from "vuex";

export default {
    components: {
        ChoferCreate,
        ChoferTable,
        ModalComponent,
    },
    props: ["numero_interno", "chofer_id", "redirect"],
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
                saldo: "",
            },
        };
    },
    watch: {
        "form.chofer_id": function (newVal) {
            this.$nextTick(() => {
                $("#chofer_id").val(newVal).trigger("change");
            });
        },
    },
    methods: {
        agregarAnticipo() {
            this.form.saldo = this.form.importe;
            this.$store
            .dispatch("agregarAnticipo", this.form)
            .then(() => {
                    this.disabled = true;
                    if (this.redirect) {
                        window.location = `/anticipos`;
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
            };
        },
        updateChoferId(chofer_id) {
            this.form.chofer_id = chofer_id;
            $("#modal_chofer").modal("hide");
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
    },
    computed: {
        ...mapGetters({
            choferes: "getChoferes",
        }),
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
