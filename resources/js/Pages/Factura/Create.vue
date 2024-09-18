<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Crear factura"
            subtitle=""
            color="#0d6efd"
            shape="square"
            :hideButtons="true"
            ref="formWizard"
        >
            <wizard-step
                slot-scope="props"
                slot="step"
                :tab="props.tab"
                :transition="props.transition"
                :index="props.index"
            >
            </wizard-step>
            <tab-content title="Datos del cliente" icon="fa fa-user">
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
            <tab-content title="Movimientos del cliente" icon="fa fa-bus">
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
import { FormWizard, TabContent, WizardStep } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Head from "./Head.vue";
import Movimiento from "./Movimiento.vue";
import Resumen from "./Resumen.vue";
import { mapActions, mapMutations } from "vuex";
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
        "sugerencia_numero_factura_1",
        "sugerencia_numero_factura_2",
    ],
    components: {
        FormWizard,
        TabContent,
        WizardStep,
        Head,
        Movimiento,
        Resumen,
    },
    mounted() {
        this.setClientes(this.clientes_data);
        this.SET_FORM_NUMERO_INTERNO(this.numero_interno);
        this.SET_FORM_NUMERO_FACTURA_1(this.sugerencia_numero_factura_1);
        this.SET_FORM_NUMERO_FACTURA_2(this.sugerencia_numero_factura_2);
    },
    methods: {
        ...mapActions("facturas", ["setClientes"]),
        ...mapMutations("facturas", [
            "SET_FORM_NUMERO_INTERNO",
            "SET_FORM_NUMERO_FACTURA_1",
            "SET_FORM_NUMERO_FACTURA_2",
        ]),

        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
    },
};
</script>
