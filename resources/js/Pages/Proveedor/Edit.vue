<template>
    <div>
        <h6><span class="text-danger">*</span>Obligatorio</h6>
        <div class="row">
            <div class="col-md-4">
                <label for="razon_social"
                    >Razon social<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.razon_social"
                    :class="{ 'is-invalid': errors.razon_social }"
                    class="form-control"
                    id="razon_social"
                />
                <span v-if="errors.razon_social" class="text-danger">{{
                    getErrorMessage(errors.razon_social)
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
                <label for="cuit">CUIT<span class="text-danger">*</span></label>
                <input
                    type="text"
                    v-model="form.cuit"
                    :class="{ 'is-invalid': errors.cuit }"
                    class="form-control"
                    id="cuit"
                />
                <span v-if="errors.cuit" class="text-danger">{{
                    getErrorMessage(errors.cuit)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="numero_ingreso_bruto"
                    >Numero de ingreso bruto<span class="text-danger"
                        >*</span
                    ></label
                >
                <input
                    type="text"
                    v-model="form.numero_ingreso_bruto"
                    :class="{ 'is-invalid': errors.numero_ingreso_bruto }"
                    class="form-control"
                    id="numero_ingreso_bruto"
                />
                <span v-if="errors.numero_ingreso_bruto" class="text-danger">{{
                    getErrorMessage(errors.numero_ingreso_bruto)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="condicion_iva_id"
                    >Condicion IVA<span class="text-danger">*</span></label
                >
                <select
                    v-model="form.condicion_iva_id"
                    :class="{ 'is-invalid': errors.condicion_iva_id }"
                    class="form-control"
                    id="condicion_iva_id"
                >
                    <option
                        v-for="condicion in condicionesIva"
                        :key="condicion.id"
                        :value="condicion.id"
                    >
                        {{ condicion.codigo }} - {{ condicion.descripcion }}
                    </option>
                </select>
                <span v-if="errors.condicion_iva_id" class="text-danger">{{
                    getErrorMessage(errors.condicion_iva_id)
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
            <div class="col-md-4">
                <label for="celular">Celular</label>
                <input
                    type="text"
                    v-model="form.celular"
                    :class="{ 'is-invalid': errors.celular }"
                    class="form-control"
                    id="celular"
                />
                <span v-if="errors.celular" class="text-danger">{{
                    getErrorMessage(errors.celular)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="provincia_id"
                    >Provincia<span class="text-danger">*</span></label
                >
                <select
                    v-model="form.provincia_id"
                    :class="{ 'is-invalid': errors.provincia_id }"
                    class="form-control"
                    id="provincia_id"
                    @change="fetchDepartamentos"
                >
                    <option
                        v-for="provincia in provincias"
                        :key="provincia.id"
                        :value="provincia.id"
                    >
                        {{ provincia.nombre }}
                    </option>
                </select>
                <span v-if="errors.provincia_id" class="text-danger">{{
                    getErrorMessage(errors.provincia_id)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="departamento_id"
                    >Departamento<span class="text-danger">*</span></label
                >
                <select
                    v-model="form.departamento_id"
                    :class="{ 'is-invalid': errors.departamento_id }"
                    class="form-control"
                    id="departamento_id"
                    @change="fetchLocalidades"
                >
                    <option
                        v-for="departamento in departamentos"
                        :key="departamento.id"
                        :value="departamento.id"
                    >
                        {{ departamento.nombre }}
                    </option>
                </select>
                <span v-if="errors.departamento_id" class="text-danger">{{
                    getErrorMessage(errors.departamento_id)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="localidad_id"
                    >Localidad<span class="text-danger">*</span></label
                >
                <select
                    v-model="form.localidad_id"
                    :class="{ 'is-invalid': errors.localidad_id }"
                    class="form-control"
                    id="localidad_id"
                >
                    <option
                        v-for="localidad in localidades"
                        :key="localidad.id"
                        :value="localidad.id"
                    >
                        {{ localidad.nombre }}
                    </option>
                </select>
                <span v-if="errors.localidad_id" class="text-danger">{{
                    getErrorMessage(errors.localidad_id)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="codigo_postal"
                    >Codigo postal<span class="text-danger">*</span></label
                >
                <input
                    type="number"
                    v-model="form.codigo_postal"
                    :class="{ 'is-invalid': errors.codigo_postal }"
                    class="form-control"
                    id="codigo_postal"
                />
                <span v-if="errors.codigo_postal" class="text-danger">{{
                    getErrorMessage(errors.codigo_postal)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="email"
                    >Email<span class="text-danger">*</span></label
                >
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
                <label for="contacto"
                    >Contacto<span class="text-danger">*</span></label
                >
                <input
                    type="text"
                    v-model="form.contacto"
                    :class="{ 'is-invalid': errors.contacto }"
                    class="form-control"
                    id="contacto"
                />
                <span v-if="errors.contacto" class="text-danger">{{
                    getErrorMessage(errors.contacto)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="retencion_ganancia_id"
                    >Retencion de ganancias<span class="text-danger"
                        >*</span
                    ></label
                >
                <select
                    v-model="form.retencion_ganancia_id"
                    :class="{ 'is-invalid': errors.retencion_ganancia_id }"
                    class="form-control"
                    id="retencion_ganancia_id"
                >
                    <option
                        v-for="retencion in retencionGanancias"
                        :key="retencion.id"
                        :value="retencion.id"
                    >
                        {{ retencion.codigo }} - {{ retencion.tipo }}
                    </option>
                </select>
                <span v-if="errors.retencion_ganancia_id" class="text-danger">{{
                    getErrorMessage(errors.retencion_ganancia_id)
                }}</span>
            </div>
            <div class="col-md-4">
                <label for="retencion_ingreso_bruto_id"
                    >Retencion de ingresos bruto<span class="text-danger"
                        >*</span
                    ></label
                >
                <select
                    v-model="form.retencion_ingreso_bruto_id"
                    :class="{ 'is-invalid': errors.retencion_ingreso_bruto_id }"
                    class="form-control"
                    id="retencion_ingreso_bruto_id"
                >
                    <option
                        v-for="retencion in retencionIngresoBrutos"
                        :key="retencion.id"
                        :value="retencion.id"
                    >
                        {{ retencion.descripcion }}
                    </option>
                </select>
                <span
                    v-if="errors.retencion_ingreso_bruto_id"
                    class="text-danger"
                    >{{
                        getErrorMessage(errors.retencion_ingreso_bruto_id)
                    }}</span
                >
            </div>
            <div class="col-md-4">
                <label for="plan_cuenta_id"
                    >Plan de cuenta<span class="text-danger">*</span></label
                >
                <select
                    v-model="form.plan_cuenta_id"
                    :class="{ 'is-invalid': errors.plan_cuenta_id }"
                    class="form-control"
                    id="plan_cuenta_id"
                >
                    <option
                        v-for="plan in planCuentas"
                        :key="plan.id"
                        :value="plan.id"
                    >
                        {{ plan.descripcion }}
                    </option>
                </select>
                <span v-if="errors.plan_cuenta_id" class="text-danger">{{
                    getErrorMessage(errors.plan_cuenta_id)
                }}</span>
            </div>
            <div class="col-12 d-flex justify-content-end mt-3">
                <button
                    class="btn btn-primary btn-sm"
                    @click.prevent="actualizarProveedor"
                >
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
import { actualizarProveedor } from "../../store/actions";
export default {
    props: ["redirect", "proveedor"],
    created() {
        if (this.proveedor) {
            this.setFormValues(this.proveedor);
        }
    },
    async mounted() {
        this.$store.dispatch("getProvincias");
        this.$store.dispatch("getRetencionGanancias");
        this.$store.dispatch("getRetencionIngresoBrutos");
        this.$store.dispatch("getCondicionesIva");
        this.$store.dispatch("getTipoDocumentos");
        this.$store.dispatch("getPlanCuentas");
        if (this.form.provincia_id) {
            await this.fetchDepartamentos();
        }
        if (this.form.departamento_id) {
            await this.fetchLocalidades();
        }
    },
    data() {
        return {
            form: {
                id: "",
                razon_social: "",
                cuit: "",
                celular: "",
                domicilio: "",
                numero_ingreso_bruto: "",
                condicion_iva_id: "",
                telefono: "",
                celular: "",
                provincia_id: "",
                departamento_id: "",
                localidad_id: "",
                codigo_postal: "",
                email: "",
                contacto: "",
                plan_cuenta_id: "",
                retencion_ganancia_id: "",
                retencion_ingreso_bruto_id: "",
                saldo: 0,
                estado: 1,
            },
        };
    },
    methods: {
        actualizarProveedor() {
            this.$store
                .dispatch("actualizarProveedor", this.form)
                .then(() => {
                    if (this.redirect) {
                        window.location = "/proveedores";
                        return;
                    }
                    this.resetForm();
                    this.$toast.open({
                        message: "Proveedor agregado exitosamente!",
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
        setFormValues(proveedor) {
            this.form.id = proveedor.id;
            this.form.razon_social = proveedor.razon_social;
            this.form.cuit = proveedor.cuit;
            this.form.celular = proveedor.celular;
            this.form.domicilio = proveedor.domicilio;
            this.form.numero_ingreso_bruto = proveedor.numero_ingreso_bruto;
            this.form.condicion_iva_id = proveedor.condicion_iva_id;
            this.form.telefono = proveedor.telefono;
            this.form.celular = proveedor.celular;
            this.form.provincia_id = proveedor.provincia_id;
            this.form.departamento_id = proveedor.departamento_id;
            this.form.localidad_id = proveedor.localidad_id;
            this.form.codigo_postal = proveedor.codigo_postal;
            this.form.email = proveedor.email;
            this.form.contacto = proveedor.contacto;
            this.form.plan_cuenta_id = proveedor.plan_cuenta_id;
            this.form.retencion_ganancia_id = proveedor.retencion_ganancia_id;
            this.form.retencion_ingreso_bruto_id =
                proveedor.retencion_ingreso_bruto_id;
            this.form.saldo = proveedor.saldo;
            this.form.estado = proveedor.estado;
        },
        async fetchDepartamentos() {
            if (this.form.provincia_id) {
                await this.$store.dispatch(
                    "getDepartamentosProvincia",
                    this.form.provincia_id
                );
                if (this.proveedor) {
                    this.form.departamento_id = this.proveedor.departamento_id;
                    await this.fetchLocalidades();
                }
            }
        },
        async fetchLocalidades() {
            if (this.form.departamento_id) {
                await this.$store.dispatch(
                    "getLocalidadesDepartamento",
                    this.form.departamento_id
                );
                if (this.proveedor) {
                    this.form.localidad_id = this.proveedor.localidad_id;
                }
            }
        },
        resetForm() {
            this.form = {
                razon_social: "",
                cuit: "",
                celular: "",
                domicilio: "",
                numero_ingreso_bruto: "",
                condicion_iva_id: "",
                telefono: "",
                celular: "",
                provincia_id: "",
                departamento_id: "",
                localidad_id: "",
                codigo_postal: "",
                email: "",
                contacto: "",
                plan_cuenta_id: "",
                retencion_ganancia_id: "",
                retencion_ingreso_bruto_id: "",
                saldo: 0,
                estado: 1,
            };
        },
        getErrorMessage(error) {
            return Array.isArray(error) ? error[0] : error;
        },
    },
    computed: {
        ...mapGetters([
            "getProvincias",
            "getDepartamentos",
            "getLocalidades",
            "getRetencionIngresoBrutos",
            "getCondicionesIva",
            "getRetencionGanancias",
            "getTipoDocumentos",
            "getPlanCuentas",
        ]),
        errors() {
            return this.$store.getters.getErrors;
        },
        provincias() {
            return this.getProvincias;
        },
        departamentos() {
            return this.getDepartamentos;
        },
        localidades() {
            return this.getLocalidades;
        },
        retencionGanancias() {
            return this.getRetencionGanancias;
        },
        retencionIngresoBrutos() {
            return this.getRetencionIngresoBrutos;
        },
        tipoDocumentos() {
            return this.getTipoDocumentos;
        },
        planCuentas() {
            return this.getPlanCuentas;
        },
        condicionesIva() {
            return this.getCondicionesIva;
        },
    },
};
</script>
