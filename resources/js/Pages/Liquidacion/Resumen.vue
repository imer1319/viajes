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
                        v-for="(movimiento, index) in form.movimientos"
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
                        <td colspan="3"></td>
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
                        v-for="(movimiento, index) in form.anticipos"
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
            <strong><i class="fas fa-hand-holding-usd"></i>Gastos</strong>
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
                    <tr v-for="(gasto, index) in form.gastos" :key="gasto.id">
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
        <div class="col-md-12">
            <strong
                ><i class="fa fa-money-check mr-1"></i>Formas de pago</strong
            >
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
        <div class="col-md-12 text-right">
            <h5 class="text-center"><i class="fa fa-book mr-3"></i>Resumen</h5>
            <strong
                >Total movimientos: <span class="text-primary">(+)</span>
                {{ totalComisionChofer | formatNumber }}</strong
            >
            <br />
            <strong
                >Total total adelantos: <span class="text-danger">(-)</span>
                {{ totalImporteAnticipo | formatNumber }}</strong
            >
            <br />
            <strong
                >Total total gastos: <span class="text-primary">(+)</span>
                {{ totalImporteGasto | formatNumber }}</strong
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
            <a
                @click.prevent="agregarLiquidacion()"
                class="btn btn-primary"
                :disabled="disabled"
                >{{ isEditing ? "Actualizar" : "Guardar" }}</a
            >
        </div>
    </div>
</template>
<script>
import { mapState, mapMutations } from "vuex";

export default {
    methods: {
        ...mapMutations("liquidaciones", ["SET_DISABLED"]),
        anterior() {
            this.$emit("anterior");
        },
        agregarLiquidacion() {
            this.form.total_liquidacion = this.totalGastoLiquidacion;
            var ruta = "liquidaciones/agregarLiquidacion";
            if (this.isEditing) {
                ruta = "liquidaciones/actualizarLiquidacion";
            }
            this.$store
                .dispatch(ruta, this.form)
                .then(() => {
                    this.SET_DISABLED(true);
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
        ...mapState("liquidaciones", {
            form: (state) => state.form,
            chofer: (state) => state.chofer,
            isEditing: (state) => state.isEditing,
            disabled: (state) => state.disabled,
        }),
        totalPrecioChofer() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.precio_chofer),
                0
            );
        },
        totalComisionChofer() {
            return this.form.movimientos?.reduce(
                (total, movimiento) =>
                    total + parseFloat(movimiento.comision_chofer),
                0
            );
        },
        totalImporteAnticipo() {
            return this.form.anticipos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
        totalImporteGasto() {
            return this.form.gastos?.reduce((total, anticipo) => {
                return total + parseFloat(anticipo.importe);
            }, 0);
        },
        totalImportePagos() {
            return this.form.formaPagos?.reduce(
                (total, forma) => total + parseFloat(forma.importe),
                0
            );
        },
        totalGastoLiquidacion() {
            return (
                this.totalComisionChofer -
                this.totalImporteAnticipo +
                this.totalImporteGasto
            );
        },
    },
};
</script>
