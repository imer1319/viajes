<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Editar factura"
            subtitle=""
            color="#0d6efd"
            shape="square"
            :hideButtons="true"
            ref="formWizard"
        >
            <tab-content title="Datos del chofer" icon="fa fa-user">
                <Head
                    @siguiente="siguienteTab()"
                    :condiciones_iva_data="condiciones_iva_data"
                    :provincias_data="provincias_data"
                    :retencion_ganancias_data="retencion_ganancias_data"
                    :retencion_ingresos_bruto_data="
                        retencion_ingresos_bruto_data
                    "
                    :tipo_documentos_data="tipo_documentos_data"
                    :condiciones_pago_data="condiciones_pago_data"
                />
            </tab-content>
            <tab-content title="Movimientos del chofer" icon="fa fa-bus">
                <Movimiento
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                />
            </tab-content>
            <tab-content title="Resumen" icon="fa fa-book">
                <Resumen @anterior="anteriorTab()" />
            </tab-content>
        </form-wizard>
    </div>
</template>
<script>
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Head from "./Head.vue";
import Movimiento from "./Movimiento.vue";
import Resumen from "./Resumen.vue";
import { mapActions, mapMutations, mapState } from "vuex";

export default {
    props: [
        "numero_interno",
        "clientes_data",
        "condiciones_iva_data",
        "provincias_data",
        "retencion_ganancias_data",
        "retencion_ingresos_bruto_data",
        "tipo_documentos_data",
        "condiciones_pago_data",
        "factura",
    ],
    components: {
        FormWizard,
        TabContent,
        Head,
        Movimiento,
        Resumen,
    },
    mounted() {
        this.setClientes(this.clientes_data);
        this.initializeForm();
    },
    computed: {
        ...mapState("facturas", {
            isEditing: (state) => state.isEditing,
        }),
    },
    methods: {
        ...mapActions("facturas", ["setForm", "setClientes"]),
        ...mapMutations("facturas", [
            "SET_IS_EDITING",
            "SET_CLIENTE_ID_ANTERIOR",
        ]),
        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
        initializeForm() {
            this.SET_IS_EDITING(true);
            this.SET_CLIENTE_ID_ANTERIOR(this.factura.cliente_id);
            this.setForm({
                id: this.factura.id,
                fecha: this.factura.fecha,
                cliente_id: this.factura.cliente_id,
                numero_interno: this.factura.numero_interno,
                observaciones: this.factura.observaciones,
                condiciones_pago_id: this.factura.condiciones_pago_id,
                neto: this.factura.neto,
                iva: this.factura.iva,
                total: this.factura.total,
                numero_factura_1: this.factura.numero_factura_1,
                numero_factura_2: this.factura.numero_factura_2,
                movimientos: this.factura.movimientos,
            });
        },
    },
};
</script>
