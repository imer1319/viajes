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
import { FormWizard, TabContent } from "vue-form-wizard";
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
        this.SET_FORM_NUMERO_INTERNO(this.numero_interno);
    },
    methods: {
        ...mapActions("facturas", ["setClientes"]),
        ...mapMutations("facturas", ["SET_FORM_NUMERO_INTERNO"]),

        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
    },
};
</script>
