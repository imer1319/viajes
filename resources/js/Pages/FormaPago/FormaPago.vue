<template>
    <div class="row">
        <div class="col-12">
            <h5 class="text-center">
                Monto faltante: {{ monto_faltante | formatNumber }}
            </h5>
        </div>

        <div
            class="col-md-6"
            v-if="[1, 7].includes(Number(form_pago.forma_pago_id))"
        >
            <label for="banco_id">Bancos</label>
            <select
                id="banco_id"
                class="form-control"
                v-model="form_pago.banco_id"
            >
                <option
                    :value="banco.id"
                    v-for="banco in bancos"
                    :key="banco.id"
                >
                    {{ banco.descripcion }}
                </option>
            </select>
            <span v-if="errors['form_pago.banco_id']" class="text-danger">
                {{ getErrorMessage(errors["form_pago.banco_id"]) }}
            </span>
        </div>

        <div
            class="col-md-6"
            v-if="
                [1, 2, 3, 4, 5, 6, 7].includes(Number(form_pago.forma_pago_id))
            "
        >
            <label for="importe">Importe</label>
            <input
                type="text"
                class="form-control"
                v-model="form_pago.importe"
            />
            <span v-if="errors['form_pago.importe']" class="text-danger">
                {{ getErrorMessage(errors["form_pago.importe"]) }}
            </span>
        </div>

        <div
            class="col-md-6"
            v-if="[1, 3, 4, 5, 6, 7].includes(Number(form_pago.forma_pago_id))"
        >
            <label for="numero">Numero</label>
            <input
                type="text"
                class="form-control"
                v-model="form_pago.numero"
            />
            <span v-if="errors['form_pago.numero']" class="text-danger">
                {{ getErrorMessage(errors["form_pago.numero"]) }}
            </span>
        </div>

        <div
            class="col-md-6"
            v-if="[1, 3, 4, 5, 6, 7].includes(Number(form_pago.forma_pago_id))"
        >
            <label for="fecha_emision">Fecha emision</label>
            <input
                type="date"
                class="form-control"
                v-model="form_pago.fecha_emision"
            />
            <span v-if="errors['form_pago.fecha_emision']" class="text-danger">
                {{ getErrorMessage(errors["form_pago.fecha_emision"]) }}
            </span>
        </div>

        <div
            class="col-md-6"
            v-if="[1].includes(Number(form_pago.forma_pago_id))"
        >
            <label for="fecha_vencimiento">Fecha vencimiento</label>
            <input
                type="date"
                class="form-control"
                v-model="form_pago.fecha_vencimiento"
            />
            <span
                v-if="errors['form_pago.fecha_vencimiento']"
                class="text-danger"
            >
                {{ getErrorMessage(errors["form_pago.fecha_vencimiento"]) }}
            </span>
        </div>
        <div class="col-md-12 mt-3">
            <a @click.prevent="agregar()" class="btn btn-primary">Agregar</a>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    props: {
        bancos: Array,
        vuexModule: {
            type: String,
            required: true,
        },
    },
    methods: {
        agregar() {
            this.$emit("agregar");
        },
        getErrorMessage(error) {
            return error ? error[0] : "";
        },
    },
    computed: {
        ...mapState({
            errors(state) {
                return state[this.vuexModule].errors;
            },
            form_pago(state) {
                return state[this.vuexModule].form_pago;
            },
            monto_faltante(state) {
                return state[this.vuexModule].monto_faltante;
            },
        }),
    },
};
</script>
