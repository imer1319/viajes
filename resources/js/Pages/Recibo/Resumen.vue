<template>
    <div class="row">
        <div class="col-md-6">
            <strong><i class="fa fa-user mr-2"></i>Cliente:</strong>
            {{ cliente.razon_social }}
            <p class="text-muted"><b>CUIT:</b> {{ cliente.cuit }}</p>
        </div>
        <div class="col-md-12">
            <h5>Facturas del cliente</h5>
            <table class="table table-bordered col-md-12">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th># Factura</th>
                        <th>Importe</th>
                        <th>Saldo total</th>
                        <th>Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(factura, index) in form.facturas"
                        :key="factura.id"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ factura.fecha }}</td>
                        <td>
                            {{ factura.numero_factura_1 }}-{{
                                factura.numero_factura_2
                            }}
                        </td>
                        <td>{{ factura.total }}</td>
                        <td>{{ factura.saldo_total | formatNumber }}</td>
                        <td>{{ factura.pago | formatNumber }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><b>Totales</b></td>
                        <td>{{ totalImporte | formatNumber }}</td>
                        <td>{{ totalSaldoTotal | formatNumber }}</td>
                        <td>{{ totalPago | formatNumber }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12">
            <h5>Formas de pago</h5>
            <table class="table table-bordered col-md-12">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Forma</th>
                        <th>Descripcion</th>
                        <th>Fecha emision</th>
                        <th>Fecha vencimiento</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(forma, index) in form.formaPagos" :key="index">
                        <td>{{ forma.numero }}</td>
                        <td>{{ forma.abreviacion }}</td>
                        <td>{{ forma.descripcion }}</td>
                        <td>{{ forma.fecha_emision }}</td>
                        <td>{{ forma.fecha_vencimiento }}</td>
                        <td>{{ forma.importe | formatNumber }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><b>Totales</b></td>
                        <td>{{ totalImportePagos | formatNumber }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-12 d-flex justify-content-between mt-3">
            <button class="btn btn-primary" @click.prevent="anterior()">
                Anterior
            </button>
            <a @click.prevent="agregarRecibo()" class="btn btn-primary">{{
                isEditing ? "Actualizar" : "Guardar"
            }}</a>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";

export default {
    methods: {
        anterior() {
            this.$emit("anterior");
        },
        agregarRecibo() {
            this.form.total_recibo = this.totalPago;
            var ruta = "recibos/agregarRecibo";
            if (this.isEditing) {
                ruta = "recibos/actualizarRecibo";
            }
            this.$store
                .dispatch(ruta, this.form)
                .then(() => {
                    window.location = "/recibos";
                    this.$toast.open({
                        message: "Datos guardados exitosamente!",
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
    },
    computed: {
        ...mapState("recibos", {
            form: (state) => state.form,
            cliente: (state) => state.cliente,
            isEditing: (state) => state.isEditing,
        }),
        totalImporte() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.total),
                0
            );
        },
        totalSaldoTotal() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.saldo_total),
                0
            );
        },
        totalPago() {
            return this.form.facturas?.reduce(
                (total, factura) => total + parseFloat(factura.pago || 0),
                0
            );
        },
        totalImportePagos() {
            return this.form.formaPagos?.reduce(
                (total, forma) => total + parseFloat(forma.importe),
                0
            );
        },
    },
};
</script>
