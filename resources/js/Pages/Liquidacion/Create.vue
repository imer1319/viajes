<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Formulario"
            subtitle=""
            color="#0d6efd"
            shape="square"
            :hideButtons="true"
            ref="formWizard"
        >
            <tab-content title="Datos del cliente" icon="fa fa-user">
                <Head
                    @siguiente="siguienteTab()"
                    :numero_interno="numero_interno"
                />
            </tab-content>
            <tab-content title="Movimientos del chofer" icon="fa fa-bus">
                <Movimiento @siguiente="siguienteTab()" @anterior="anteriorTab()" />
            </tab-content>
            <tab-content
                title="Anticipos del chofer"
                icon="fas fa-comments-dollar"
            >
                <Anticipo @siguiente="siguienteTab()" @anterior="anteriorTab()" />
            </tab-content>
            <tab-content title="Gastos del chofer" icon="fa fa-money-check">
                <Gasto @siguiente="siguienteTab()" @anterior="anteriorTab()" />
            </tab-content>
            <tab-content title="Resumen" icon="fa fa-book">
                <Resumen @anterior="anteriorTab()"/>
            </tab-content>
        </form-wizard>
    </div>
</template>
<script>
import { FormWizard, TabContent } from "vue-form-wizard";
import "vue-form-wizard/dist/vue-form-wizard.min.css";
import Head from "./Head.vue";
import Movimiento from "./Movimiento.vue";
import Anticipo from "./Anticipo.vue";
import Gasto from "./Gasto.vue";
import Resumen from "./Resumen.vue";
export default {
    props: ["numero_interno"],
    components: {
        FormWizard,
        TabContent,
        Head,
        Movimiento,
        Anticipo,
        Gasto,
        Resumen,
    },
    methods: {
        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
    },
};
</script>
