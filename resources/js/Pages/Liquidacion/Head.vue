<template>
    <div class="row">
        <div class="col-md-6">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" v-model="form.fecha" />
            <span v-if="errors.fecha" class="text-danger">{{
                getErrorMessage(errors.fecha)
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
        <!-- Chofer -->
        <modal-component modal_id="modal_chofer" titulo="Choferes">
            <chofer-create></chofer-create>
            <hr />
            <chofer-table
                @choferSelected="updateChoferId"
                :choferes="choferes"
            ></chofer-table>
        </modal-component>
    </div>
</template>
<script>
import ChoferCreate from "../../Pages/Chofer/Create.vue";
import ChoferTable from "../../Pages/Chofer/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapState, mapMutations } from "vuex";

export default {
    props: ["numero_interno"],
    components: {
        ChoferCreate,
        ChoferTable,
        ModalComponent,
    },
    mounted() {
        this.updateFecha();
    },
    watch: {
        "form.chofer_id": function (newVal) {
            this.$nextTick(() => {
                $("#chofer_id").val(newVal).trigger("change");
            });
        },
    },
    methods: {
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        ...mapMutations("liquidaciones", [
            "SET_FORM_FECHA",
            "SET_FORM_CHOFER_ID",
        ]),
        validarHead() {
            this.$store
                .dispatch("liquidaciones/validarHead", this.form)
                .then(() => {
                    this.$store.dispatch(
                        "liquidaciones/getMovimientosChofer",
                        this.form.chofer_id
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
        updateChoferId(chofer_id) {
            this.SET_FORM_CHOFER_ID(chofer_id);
            $("#modal_chofer").modal("hide");
        },
    },
    computed: {
        ...mapState("liquidaciones", {
            form: (state) => state.form,
            errors: (state) => state.errors,
            choferes: (state) => state.choferes,
        }),
    },
};
</script>
