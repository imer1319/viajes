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
            <cliente-create></cliente-create>
            <hr />
            <cliente-table @clienteSelected="updateClienteId"></cliente-table>
        </modal-component>
    </div>
</template>
<script>
import ClienteCreate from "../../Pages/Cliente/Create.vue";
import ClienteTable from "../../Pages/Cliente/Table.vue";
import ModalComponent from "../../components/Modal.vue";
import { mapState, mapMutations } from "vuex";

export default {
    props: ["numero_interno", "edit"],
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
        ...mapMutations([
            "SET_FECHA",
            "SET_CHOFER_ID",
            "SET_OBSERVACIONES",
            "SET_NUMERO_INTERNO",
        ]),
        validarHead() {
            this.SET_NUMERO_INTERNO(this.numero_interno);
            this.$store
                .dispatch("validarHead", this.form)
                .then(() => {
                    this.$store.dispatch(
                        "getMovimientosCliente",
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
            this.SET_FECHA(this.getTodayDate());
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
        getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, "0"); // Enero es 0
            const day = String(today.getDate()).padStart(2, "0");
            return `${year}-${month}-${day}`;
        },
        updateClienteId(cliente_id) {
            this.form.cliente_id = cliente_id;
            $("#modal_cliente").modal("hide");
        },
    },
    computed: {
        ...mapState({
            form: (state) => state.form,
        }),
        clientes() {
            return this.$store.getters.getClientes;
        },
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
