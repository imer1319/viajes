<template>
    <div>
        <h6><span class="text-danger">*</span>Obligatorio</h6>
        <div class="row">
            <div class="col-md-4">
                <label for="nombre"
                    >Nombre<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.nombre"
                    :class="{ 'is-invalid': errors.nombre }"
                    class="form-control"
                    id="nombre"
                />
                <span v-if="errors.nombre" class="text-danger">{{
                    getErrorMessage(errors.nombre)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="placa"
                    >Placa<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.placa"
                    :class="{ 'is-invalid': errors.placa }"
                    class="form-control"
                    id="placa"
                />
                <span v-if="errors.placa" class="text-danger">{{
                    getErrorMessage(errors.placa)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="marca"
                    >Marca<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.marca"
                    :class="{ 'is-invalid': errors.marca }"
                    class="form-control"
                    id="marca"
                />
                <span v-if="errors.marca" class="text-danger">{{
                    getErrorMessage(errors.marca)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="anio">Año<span class="text-danger">*</span></label>
                <input
                    type="number"
                    v-model="form.anio"
                    :class="{ 'is-invalid': errors.anio }"
                    class="form-control"
                    id="anio"
                    min="1886"
                    :max="new Date().getFullYear()"
                />
                <span v-if="errors.anio" class="text-danger">{{
                    getErrorMessage(errors.anio)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="kilometraje"
                    >Kilometraje<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.kilometraje"
                    :class="{ 'is-invalid': errors.kilometraje }"
                    class="form-control"
                    id="kilometraje"
                />
                <span v-if="errors.kilometraje" class="text-danger">{{
                    getErrorMessage(errors.kilometraje)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="identificacion"
                    >Identificacion<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.identificacion"
                    :class="{ 'is-invalid': errors.identificacion }"
                    class="form-control"
                    id="identificacion"
                />
                <span v-if="errors.identificacion" class="text-danger">{{
                    getErrorMessage(errors.identificacion)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="agregarFlota"
                    :disabled="disabled"
                >
                    Agregar
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            disabled: false,
            form: {
                nombre: "",
                placa: "",
                marca: "",
                anio: "",
                kilometraje: "",
                identificacion: "",
            },
        };
    },
    methods: {
        agregarFlota() {
            this.$store
                .dispatch("agregarFlota", this.form)
                .then(() => {
                    this.resetForm();
                    this.$toast.open({
                        message: "Flota agregado exitosamente!",
                        type: "success",
                        position: "top-right",
                    });
                })
                .catch(() => {
                    this.$toast.open({
                        message: "Corrija los siguientes errores!",
                        type: "error",
                        position: "top-right",
                    });
                });
        },
        resetForm() {
            this.form = {
                nombre: "",
                placa: "",
                marca: "",
                anio: "",
                kilometraje: "",
                identificacion: "",
            };
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
    },
    computed: {
        errors() {
            return this.$store.getters.getErrors;
        },
    },
};
</script>
