<template>
    <div>
        <h6><span class="text-danger">*</span>Obligatorio</h6>
        <div class="row">
            <div class="col-md-12">
                <label for="descripcion"
                    >Descripcion<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.descripcion"
                    :class="{ 'is-invalid': errors.descripcion }"
                    class="form-control form-control-sm"
                    id="descripcion"
                />
                <span v-if="errors.descripcion" class="text-danger">{{
                    getErrorMessage(errors.descripcion)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="agregarTipoViaje"
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
            form: {
                descripcion: "",
            },
        };
    },
    methods: {
        agregarTipoViaje() {
            this.$store
                .dispatch("agregarTipoViaje", this.form)
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
                descripcion: "",
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
