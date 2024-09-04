<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Crear Recibo"
            subtitle=""
            color="#0d6efd"
            shape="square"
            :hideButtons="true"
            ref="formWizard"
        >
            <tab-content title="Datos del cliente" icon="fa fa-user">
                <Head
                    @siguiente="siguienteTab()"
                    :condiciones_iva_data="condiciones_iva_data"
                    :provincias_data="provincias_data"
                    :retencion_ganancias_data="retencion_ganancias_data"
                    :retencion_ingresos_bruto_data="
                        retencion_ingresos_bruto_data
                    "
                    :numero_interno="numero_interno"
                    :tipo_documentos_data="tipo_documentos_data"
                />
            </tab-content>
            <tab-content title="Facturas del cliente" icon="fas fa-file-invoice">
                <Factura
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                />
            </tab-content>
            <tab-content title="Forma de pago" icon="fa fa-money-check">
                <FormaPago
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
import Factura from "./Factura.vue";
import Resumen from "./Resumen.vue";
import FormaPago from "./FormaPago.vue";
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
    ],
    components: {
        FormWizard,
        TabContent,
        Head,
        Factura,
        FormaPago,
        Resumen,
    },
    mounted() {
        this.setClientes(this.clientes_data);
        this.SET_FORM_NUMERO_INTERNO(this.numero_interno);
    },
    methods: {
        ...mapActions("recibos", ["setClientes"]),
        ...mapMutations("recibos", ["SET_FORM_NUMERO_INTERNO"]),

        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
    },
};
</script>
