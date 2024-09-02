<template>
    <div class="row">
        <div class="col-md-6">
            <strong><i class="fas fa-money-check mr-1"></i> Cliente</strong>
            <p class="text-muted">Razon social: {{ cliente.razon_social }}</p>
            <p class="text-muted">CUIT : {{ cliente.cuit }}</p>
        </div>
        <div class="col-md-6">
            <strong
                ><i class="fas fa-money-check mr-1"></i>Datos del la
                factura</strong
            >
            <p class="text-muted">Fecha: {{ form.fecha }}</p>
            <p class="text-muted">Observaciones: {{ form.observaciones }}</p>
        </div>
        <div class="col-md-12">
            <strong><i class="fa fa-bus mr-1"></i>Movimientos</strong>
            <table class="table table-bordered col-md-12">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tipo de viaje</th>
                        <th>Precio real</th>
                        <th>IVA</th>
                        <th>Saldo total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(movimiento, index) in form.movimientos"
                        :key="movimiento.id"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ movimiento.fecha }}</td>
                        <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                        <td>{{ movimiento.precio_real | formatNumber }}</td>
                        <td>{{ movimiento.iva | formatNumber }}</td>
                        <td>{{ movimiento.total | formatNumber }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-right">
            <h5 class="text-center"><i class="fa fa-book mr-3"></i>Resumen</h5>
            <p>Neto: {{ totalPrecioReal | formatNumber }}</p>
            <p>Iva: {{ totalIva | formatNumber }}</p>
            <p>Total: {{ totalSaldo | formatNumber }}</p>
        </div>
        <div class="col-12 d-flex justify-content-between mt-3">
            <button class="btn btn-primary" @click.prevent="anterior()">
                Anterior
            </button>
            <a @click.prevent="agregarFactura()" class="btn btn-primary"
                >Guardar</a
            >
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
        agregarFactura() {
            this.form.saldo_total = this.totalSaldo;
            this.form.total = this.totalSaldo;
            this.form.neto = this.totalPrecioReal;
            this.form.iva = this.totalIva;
            this.$store
                .dispatch("facturas/agregarFactura", this.form)
                .then(() => {
                    window.location = "/facturaciones";
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
        ...mapState("facturas", {
            form: (state) => state.form,
            cliente: (state) => state.cliente,
        }),
        totalPrecioReal() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.precio_real),
                0
            );
        },
        totalIva() {
            return this.form.movimientos?.reduce(
                (total, movimiento) => total + parseFloat(movimiento.iva),
                0
            );
        },
        totalSaldo() {
            return this.form.movimientos?.reduce(
                (total, movimiento) => total + parseFloat(movimiento.total),
                0
            );
        },
    },
};
</script>
