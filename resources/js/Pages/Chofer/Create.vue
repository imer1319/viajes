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
                <label for="fecha_nacimiento"
                    >Fecha de nacimiento<span class="text-danger"
                        >*</span
                    ></label
                >
                <input
                    type="date"
                    v-model="form.fecha_nacimiento"
                    :class="{ 'is-invalid': errors.fecha_nacimiento }"
                    class="form-control"
                    id="fecha_nacimiento"
                />
                <span v-if="errors.fecha_nacimiento" class="text-danger">{{
                    getErrorMessage(errors.fecha_nacimiento)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="cuil">CUIL<span class="text-danger">*</span></label>
                <input
                    type="text"
                    v-model="form.cuil"
                    :class="{ 'is-invalid': errors.cuil }"
                    class="form-control"
                    id="cuil"
                />
                <span v-if="errors.cuil" class="text-danger">{{
                    getErrorMessage(errors.cuil)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="dni">DNI<span class="text-danger">*</span></label>
                <input
                    type="text"
                    v-model="form.dni"
                    :class="{ 'is-invalid': errors.dni }"
                    class="form-control"
                    id="dni"
                />
                <span v-if="errors.dni" class="text-danger">{{
                    getErrorMessage(errors.dni)
                }}</span>
            </div>
            <div class="col-md-8">
                <label for="domicilio"
                    >Domicilio<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.domicilio"
                    :class="{ 'is-invalid': errors.domicilio }"
                    class="form-control"
                    id="domicilio"
                />
                <span v-if="errors.domicilio" class="text-danger">{{
                    getErrorMessage(errors.domicilio)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="email">Email</label>
                <input
                    type="email"
                    v-model="form.email"
                    :class="{ 'is-invalid': errors.email }"
                    class="form-control"
                    id="email"
                />
                <span v-if="errors.email" class="text-danger">{{
                    getErrorMessage(errors.email)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="telefono"
                    >Telefono<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.telefono"
                    :class="{ 'is-invalid': errors.telefono }"
                    class="form-control"
                    id="telefono"
                />
                <span v-if="errors.telefono" class="text-danger">{{
                    getErrorMessage(errors.telefono)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="agregarChofer"
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
    props: ["redirect"],
    data() {
        return {
            disabled: false,
            form: {
                nombre: "",
                fecha_nacimiento: "",
                cuil: "",
                dni: "",
                domicilio: "",
                email: "",
                telefono: "",
                saldo: 0,
            },
        };
    },
    methods: {
        agregarChofer() {
            this.$store
                .dispatch("agregarChofer", this.form)
                .then(() => {
                    this.disabled = true;
                    if (this.redirect) {
                        window.location = "/choferes";
                        return;
                    }
                    this.resetForm();
                    this.$toast.open({
                        message: "Chofer agregado exitosamente!",
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
                fecha_nacimiento: "",
                cuil: "",
                dni: "",
                domicilio: "",
                email: "",
                telefono: "",
                saldo: 0,
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
