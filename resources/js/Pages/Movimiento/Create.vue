<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <label for="numero_interno">Numero interno</label>
                <input type="text" class="form-control" v-model="form.numero_interno">
            </div>
            <div class="col-md-6">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" v-model="form.fecha">
            </div>

            <div class="col-md-6">
                <label for="cliente_id">Cliente</label>
                <div class="input-group ">
                    <select class="form-control select2" v-model="form.cliente_id" name="cliente_id" id="cliente_id">
                        <option selected="selected">Cliente 1</option>
                        <option>Cliente 2</option>
                        <option>Cliente 3</option>
                        <option>Cliente 4</option>
                        <option>Cliente 5</option>
                        <option>Cliente 6</option>
                        <option>Cliente 7</option>
                    </select>
                    <button class="btn btn-primary" type="button" id="button-addon2"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>

            <div class="col-md-6">
                <label for="tipo_viaje_id">Tipo de viaje</label>
                <div class="input-group ">
                    <select class="form-control select2" v-model="form.tipo_viaje_id">
                        <option selected="selected">Quimico</option>
                        <option>Cueros</option>
                        <option>Varios</option>
                    </select>
                    <button class="btn btn-primary" type="button" id="button-addon2"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>

            <div class="col-md-12">
                <label for="detalle">Detalle</label>
                <div class="input-group ">
                    <textarea v-model="form.detalle" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="numero_factura">Numero de factura</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" v-model="form.numero_factura_1" class="form-control text-right"
                            id="numero_factura_1" @input="handleInput($event, 4)" @blur="handleBlur($event, 4)">
                    </div>
                    <div class="col-md-8">
                        <input type="text" v-model="form.numero_factura_2" class="form-control text-right"
                            id="numero_factura_2" @input="handleInput($event, 8)" @blur="handleBlur($event, 8)">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="precio_real">Precio real</label>
                <input type="number" class="form-control" step="0.1" v-model="form.precio_real" id="precio_real">
            </div>
            <div class="col-md-4">
                <label for="iva">IVA</label>
                <input type="text" class="form-control" v-model="form.iva" readonly id="iva">
            </div>
            <div class="col-md-4">
                <label for="total">Total</label>
                <input type="text" class="form-control" v-model="form.total" readonly id="total">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="flota_id">Flota</label>
                <div class="input-group ">
                    <select class="form-control select2" v-model="form.flota_id" id="flota_id">
                        <option disabled value="">Seleccione una flota</option>
                        <option v-for="flota in flotas" :key="flota.id" :value="flota.id">{{ flota.nombre }}
                        </option>
                    </select>
                    <button class="btn btn-primary" type="button" id="button-addon2"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="chofer_id">Chofer</label>
                <div class="input-group ">
                    <select class="form-control select2" v-model="form.chofer_id" id="chofer_id">
                        <option v-for="chofer in choferes" :key="chofer.id" :value="chofer.id">{{ chofer.nombre }}
                        </option>
                    </select>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_chofer">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="precio_chofer">Precio Chofer</label>
                <input type="number" class="form-control" step="0.1" v-model="form.precio_chofer" id="precio_chofer">
            </div>
            <div class="col-md-4">
                <label for="porcentaje_pago">Porcentaje Pago</label>
                <input type="number" class="form-control" v-model="form.porcentaje_pago" id="porcentaje_pago">
            </div>
            <div class="col-md-4">
                <label for="comision_chofer">Comision Chofer</label>
                <input type="text" class="form-control" v-model="form.comision_chofer" readonly id="comision_chofer">
            </div>
        </div>

        <div class="row">
            <div class="col mt-3">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <!-- Chofer -->
        <modal-component modal_id="modal_chofer" titulo="Choferes">
            <chofer-create></chofer-create>
            <hr>
            <chofer-table @choferSelected="updateChoferId"></chofer-table>
        </modal-component>
    </div>
</template>
<script>
import ChoferCreate from '../../Pages/Chofer/Create.vue'
import ChoferTable from '../../Pages/Chofer/Table.vue'
import ModalComponent from '../../components/Modal.vue'
export default {
    components: {
        ChoferCreate,
        ModalComponent,
        ChoferTable
    },
    mounted() {
        this.form.fecha = this.getTodayDate();
    },
    data() {
        return {
            form: {
                numero_interno: '',
                fecha: '',
                cliente_id: '',
                tipo_viaje_id: '',
                detalle: '',
                numero_factura_1: '',
                numero_factura_2: '',
                precio_real: '',
                iva: 0,
                total: 0,
                saldo_total: '',
                flota_id: '',
                chofer_id: '',
                precio_chofer: '',
                porcentaje_pago: 16,
                comision_chofer: 0,
                saldo_comision_chofer: 0
            },
        }
    },
    computed: {
        choferes() {
            return this.$store.state.choferes;
        },
        flotas() {
            return this.$store.state.choferes;
        },
    },
    watch: {
        'form.precio_real': function (newVal) {
            this.form.iva = (newVal * 0.21).toFixed(2);
            this.form.total = (parseFloat(newVal) + parseFloat(this.form.iva)).toFixed(2);
        },
        'form.precio_chofer': function (newVal) {
            this.form.comision_chofer = (newVal * (this.form.porcentaje_pago / 100)).toFixed(2);
        },
        'form.chofer_id': function (newVal) {
            this.$nextTick(() => {
                $('#chofer_id').val(newVal).trigger('change');
            });
        }
    },
    methods: {
        updateChoferId(chofer_id) {
            this.form.chofer_id = chofer_id;
            $('#modal_chofer').modal('hide')
        },
        getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        padLeftZeros(value, length) {
            return value.toString().padStart(length, '0');
        },
        handleInput(event, maxLength) {
            let value = event.target.value.replace(/\D/g, '');
            if (value.length > maxLength) {
                value = value.substring(0, maxLength);
            }
            event.target.value = value;
            this.updateValue(event.target.id, value);
        },
        handleBlur(event, maxLength) {
            let value = event.target.value;
            value = this.padLeftZeros(value, maxLength);
            event.target.value = value;
            this.updateValue(event.target.id, value);
        },
        updateValue(id, value) {
            if (id === 'numero_factura_1') {
                this.form.numero_factura_1 = value;
            } else if (id === 'numero_factura_2') {
                this.form.numero_factura_2 = value;
            }
        }
    }
}
</script>