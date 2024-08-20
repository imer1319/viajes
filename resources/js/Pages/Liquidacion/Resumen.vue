<template>
    <div class="row">
        <div class="col-md-6">
            <strong><i class="fas fa-money-check mr-1"></i> Chofer</strong>
            <p class="text-muted">Nombre: {{ chofer.nombre }}</p>
            <p class="text-muted">CUIL : {{ chofer.cuil }}</p>
            <p class="text-muted">DNI : {{ chofer.dni }}</p>
        </div>
        <div class="col-md-6">
            <strong
                ><i class="fas fa-money-check mr-1"></i>Datos del la
                liquidacion</strong
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
                        <th>Cliente</th>
                        <th>Tipo de viaje</th>
                        <th>Precio chofer</th>
                        <th>%</th>
                        <th>Comision chofer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(movimiento, index) in movimientos"
                        :key="movimiento.id"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ movimiento.fecha }}</td>
                        <td>{{ movimiento.cliente.razon_social }}</td>
                        <td>{{ movimiento.tipo_viaje.descripcion }}</td>
                        <td>{{ movimiento.precio_chofer | formatNumber }}</td>
                        <td>{{ movimiento.porcentaje_pago }}</td>
                        <td>{{ movimiento.comision_chofer | formatNumber }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Totales</b></td>
                        <td></td>
                        <td></td>
                        <td>{{ totalPrecioChofer | formatNumber }}</td>
                        <td></td>
                        <td>{{ totalComisionChofer | formatNumber }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12">
            <strong
                ><i class="fas fa-comments-dollar mr-1"></i>Anticipos</strong
            >
            <table class="table table-bordered col-md-12">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Numero interno</th>
                        <th>Fecha</th>
                        <th>importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(movimiento, index) in anticipos"
                        :key="movimiento.id"
                    >
                        <td>{{ index + 1 }}</td>
                        <td>{{ movimiento.numero_interno }}</td>
                        <td>{{ movimiento.fecha }}</td>
                        <td>{{ movimiento.importe | formatNumber }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Totales</b></td>
                        <td></td>
                        <td>{{ totalImporteAnticipo | formatNumber }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12">
            <strong><i class="fa fa-money-check mr-1"></i>Gastos</strong>
            <table class="table table-bordered col-md-12">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Flota</th>
                        <th>Chofer</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(gasto, index) in gastos" :key="gasto.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ gasto.fecha }}</td>
                        <td>{{ gasto.proveedor.razon_social }}</td>
                        <td>{{ gasto.flota.nombre }}</td>
                        <td>{{ gasto.chofer.nombre }}</td>
                        <td>{{ gasto.importe | formatNumber }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>Totales</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ totalImporteGasto | formatNumber }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12 text-right">
            <h5 class="text-center"><i class="fa fa-book mr-3"></i>Resumen</h5>
            <strong
                >Total movimientos: <span class="text-primary">(+)</span>
                {{ totalComisionChofer | formatNumber }}</strong
            >
            <br />
            <strong
                >Total total gastos: <span class="text-danger">(-)</span>
                {{ totalImporteGasto | formatNumber }}</strong
            >
            <br />
            <strong
                >Total total adelantos: <span class="text-primary">(+)</span>
                {{ totalImporteAnticipo | formatNumber }}</strong
            >
            <br />
            <hr />
            <strong
                >Total a liquidar:
                {{ totalGastoLiquidacion | formatNumber }}</strong
            >
        </div>
        <div class="col-12 d-flex justify-content-between mt-3">
            <button class="btn btn-primary" @click.prevent="anterior()">
                Anterior
            </button>
            <a @click.prevent="agregarLiquidacion()" class="btn btn-primary"
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
        agregarLiquidacion() {
            this.form.total_liquidacion = this.totalGastoLiquidacion;
            this.form.anticipos = this.anticipos;
            this.form.gastos = this.gastos;
            this.form.movimientos = this.movimientos;
            this.$store
                .dispatch("agregarLiquidacion", this.form)
                .then(() => {
                    window.location = "/liquidaciones";
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
        ...mapState({
            form: (state) => state.form,
            chofer: (state) => state.chofer,
            movimientos: (state) => state.movimientos,
            gastos: (state) => state.gastos,
            anticipos: (state) => state.anticipos,
        }),
        totalPrecioChofer() {
            return this.movimientos?.reduce((total, movimiento) => {
                return total + parseFloat(movimiento.precio_chofer);
            }, 0);
        },
        totalComisionChofer() {
            return this.movimientos?.reduce((total, movimiento) => {
                return total + parseFloat(movimiento.comision_chofer);
            }, 0);
        },
        totalImporteAnticipo() {
            return this.anticipos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
        totalImporteGasto() {
            return this.gastos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
        totalGastoLiquidacion() {
            return (
                this.totalComisionChofer -
                this.totalImporteGasto +
                this.totalImporteAnticipo
            );
        },
    },
};
</script>
