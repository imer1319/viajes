<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Formulario"
            subtitle="organizando"
            color="#0d6efd"
            :hideButtons="true"
            ref="formWizard"
        >
            <tab-content title="Datos del cliente" icon="fa fa-user">
                <Head @siguiente="siguienteTab()" />
            </tab-content>
            <tab-content title="Movimientos del cliente" icon="fa fa-bus">
                <Movimiento @siguiente="siguienteTab()" />
            </tab-content>
            <tab-content
                title="Anticipos del chofer"
                icon="fas fa-comments-dollar "
            >
                <Anticipo @siguiente="siguienteTab()" />
            </tab-content>
            <tab-content title="Gastos del chofer" icon="fa fa-money-check">
                <Gasto @siguiente="siguienteTab()" />
                Traer todos los gastos donde el saldo del chofer sea distinto de
                0
            </tab-content>
            <tab-content title="Resumen" icon="fa fa-book">
                <Resumen />
                Resumen de lo que hay que enviar
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
    },
    computed: {
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
