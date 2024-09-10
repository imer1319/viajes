const state = {
    cliente: {},
    isEditing: false,
    cliente_id_anterior: null,

    form: {
        id: "",
        fecha: "",
        cliente_id: "",
        numero_interno: "",
        observaciones: "",
        total: "",
        total_factura: "",
        total_pagado: "",
        total_forma: "",
        facturas: [],
        formaPagos: []
    },
    form_pago: {
        id: '',
        forma_pago_id: '',
        banco_id: '',
        importe: '',
        f_emision: '',
        f_vencimiento: '',
    },
    forma_pago_selected: '',
    removedFacturas: [],
    clientes: [],
    errors: {},
};

const getters = {
};

const actions = {
    async getFacturasCliente({ commit, state }, cliente_id) {
        try {
            const response = await axios.get(`/api/recibos/${cliente_id}?edit=${state.isEditing}&cliente_id_anterior=${state.cliente_id_anterior}&factura=${state.form.id}`);
            const clienteData = response.data.cliente;
            const facturas = response.data.facturas;
            commit('SET_CLIENTE', clienteData);

            if (state.isEditing) {
                commit('SET_FORM_FACTURAS', facturas);
                commit('SET_REMOVED_FACTURAS', response.data.facturasCero);
            } else {
                commit('SET_FORM_FACTURAS', facturas);
            }
        } catch (error) {
            console.error("Error al traer los facturas del cliente:", error);
        }
    },
    async validarHead({ commit, dispatch }, form) {
        try {
            await axios.post('/api/recibos/head', form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async validarFacturas({ commit, dispatch }, form) {
        try {
            await axios.post('/api/recibos/facturas', { form });
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async agregarFactura({ commit, dispatch }, form) {
        try {
            await axios.post('/api/facturaciones', form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async actualizarFactura({ commit, dispatch }, form) {
        try {
            await axios.put('/api/facturaciones/' + form.id, form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    setClientes({ commit }, clientes) {
        commit('SET_CLIENTES', clientes);
    },
    clearErrors({ commit }) {
        commit('CLEAR_ERRORS');
    },
    updateErrors({ commit }, errors) {
        commit('SET_ERRORS', errors);
    },
    setForm({ commit }, formData) {
        commit('SET_FORM', formData);
    },
};

const mutations = {
    SET_PAGO_FORMA_PAGO_ID(state, forma_pago_id) {
        state.form_pago.forma_pago_id = forma_pago_id;
    },
    SET_CLIENTES(state, clientes) {
        state.clientes = clientes;
    },
    SET_FORM_CLIENTE_ID(state, cliente_id) {
        state.form.cliente_id = cliente_id
    },
    SET_CONDICION_PAGO_ID(state, condiciones_pago_id) {
        state.form.condiciones_pago_id = condiciones_pago_id
    },
    SET_REMOVED_FACTURAS(state, facturasCero) {
        state.removedFacturas = facturasCero;
    },
    SET_FORM_FACTURAS(state, facturas) {
        state.form.facturas = facturas;
    },
    SET_FORM_FECHA(state, fecha) {
        state.form.fecha = fecha;
    },
    SET_FORM_CHOFER_ID(state, chofer_id) {
        state.form.chofer_id = chofer_id
    },
    SET_FORM_OBSERVACIONES(state, observaciones) {
        state.form.observaciones = observaciones
    },
    SET_FORM_TOTAL_FACTURA(state, totalFactura) {
        state.form.total_factura = totalFactura;
    },
    SET_FORM_TOTAL_PAGODO(state, total_pagado) {
        state.form.total_pagado = total_pagado;
    },
    SET_FORM_NUMERO_INTERNO(state, numero_interno) {
        state.form.numero_interno = numero_interno
    },
    SET_CLIENTE(state, cliente) {
        state.cliente = cliente
    },
    SET_CLIENTE_ID_ANTERIOR(state, cliente_id) {
        state.cliente_id_anterior = cliente_id;
    },
    REMOVE_FACTURA(state, index) {
        const removedItem = state.form.facturas.splice(index, 1)[0];
        state.removedFacturas.push(removedItem);
    },
    AGREGAR_FACTURA(state, index) {
        const restoredItem = state.removedFacturas.splice(index, 1)[0];
        state.form.facturas.push(restoredItem);
    },
    CLEAR_ERRORS(state) {
        state.errors = {};
    },
    SET_ERRORS(state, errors) {
        state.errors = errors;
    },
    SET_IS_EDITING(state, isEditing) {
        state.isEditing = isEditing;
    },
    SET_FORM(state, data) {
        state.form = data;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};