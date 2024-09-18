<template>
    <div>
        <form-wizard
            next-button-text="Siguiente"
            title="Editar Recibo"
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
                />
            </tab-content>
            <tab-content
                title="Facturas del cliente"
                icon="fas fa-file-invoice"
            >
                <Factura
                    @siguiente="siguienteTab()"
                    @anterior="anteriorTab()"
                />
            </tab-content>
            <tab-content title="Forma de pago" icon="fa fa-money-check">
                <FormaPago
                    :forma_pagos="forma_pagos"
                    :bancos="bancos"
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
import Factura from "./Factura.vue";
import FormaPago from "./FormaPago.vue";
import Resumen from "./Resumen.vue";
import { mapActions, mapMutations, mapState } from "vuex";

export default {
    props: [
        "recibo",
        "clientes_data",
        "condiciones_iva_data",
        "provincias_data",
        "retencion_ganancias_data",
        "retencion_ingresos_bruto_data",
        "tipo_documentos_data",
        "forma_pagos",
        "bancos",
    ],
    components: {
        FormWizard,
        TabContent,
        WizardStep,
        Head,
        Factura,
        FormaPago,
        Resumen,
    },
    mounted() {
        this.setClientes(this.clientes_data);
        this.initializeForm();
    },
    computed: {
        ...mapState("recibos", {
            isEditing: (state) => state.isEditing,
        }),
    },
    methods: {
        ...mapActions("recibos", ["setForm", "setClientes"]),
        ...mapMutations("recibos", [
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
            this.SET_CLIENTE_ID_ANTERIOR(this.recibo.cliente_id);
            this.setForm({
                id: this.recibo.id,
                fecha: this.recibo.fecha,
                cliente_id: this.recibo.cliente_id,
                numero_interno: this.recibo.numero_interno,
                observaciones: this.recibo.observaciones,
                saldo_total: this.recibo.saldo_total,
                total_recibo: this.recibo.total_recibo,
                facturas: this.recibo.facturas,
                formaPagos: this.recibo.pagos,
            });
        },
    },
};
</script>
