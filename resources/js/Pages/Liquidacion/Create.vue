<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Crear liquidacion"
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
            <tab-content title="Datos del chofer" icon="fa fa-user">
                <Head @siguiente="siguienteTab()" />
            </tab-content>
            <tab-content title="Movimientos del chofer" icon="fa fa-bus">
                <Movimiento
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                />
            </tab-content>
            <tab-content
                title="Anticipos del chofer"
                icon="fas fa-comments-dollar"
            >
                <Anticipo
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                />
            </tab-content>
            <tab-content
                title="Gastos del chofer"
                icon="fas fa-hand-holding-usd"
            >
                <Gasto @siguiente="siguienteTab()" @anterior="anteriorTab()" />
            </tab-content>
            <tab-content title="Forma de pago" icon="fa fa-money-check">
                <FormaPago
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                    :forma_pagos="forma_pagos"
                    :bancos="bancos"
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
import Anticipo from "./Anticipo.vue";
import Gasto from "./Gasto.vue";
import FormaPago from "./FormaPago.vue";
import Resumen from "./Resumen.vue";
import { mapActions, mapMutations } from "vuex";
export default {
    props: ["numero_interno", "choferes", "bancos", "forma_pagos"],
    components: {
        FormWizard,
        TabContent,
        WizardStep,
        Head,
        Movimiento,
        Anticipo,
        Gasto,
        FormaPago,
        Resumen,
    },
    mounted() {
        this.setChoferes(this.choferes);
        this.SET_FORM_NUMERO_INTERNO(this.numero_interno);
    },
    methods: {
        ...mapActions("liquidaciones", ["setChoferes"]),
        ...mapMutations("liquidaciones", ["SET_FORM_NUMERO_INTERNO"]),

        siguienteTab() {
            this.$refs.formWizard.nextTab();
        },
        anteriorTab() {
            this.$refs.formWizard.prevTab();
        },
    },
};
</script>
