const state = {
    cliente: {},
    isEditing: false,
    disabled: false,
    cliente_id_anterior: null,
    form: {
        id: "",
        fecha: "",
        cliente_id: "",
        numero_factura_1: '',
        numero_factura_2: '',
        numero_interno: "",
        observaciones: "",
        condiciones_pago_id: "",
        neto: "",
        iva: "",
        total: "",
        saldo_total: "",
        movimientos: [],
    },
    removedMovimientos: [],
    clientes: [],
    errors: {},
};

const getters = {
};

const actions = {
    async getMovimientosCliente({ commit, state }, cliente_id) {
        try {
            const response = await axios.get(`/api/facturacion/${cliente_id}?edit=${state.isEditing}&cliente_id_anterior=${state.cliente_id_anterior}&factura=${state.form.id}`);
            const clienteData = response.data.cliente;
            const movimientos = response.data.movimientos;
            commit('SET_CLIENTE', clienteData);

            if (state.isEditing) {
                commit('SET_FORM_MOVIMIENTOS', movimientos);
                commit('SET_REMOVED_MOVIMIENTOS', response.data.movimientosCero);
            } else {
                commit('SET_FORM_MOVIMIENTOS', movimientos);
            }
        } catch (error) {
            console.error("Error al traer los movimientos del cliente:", error);
        }
    },
    async validarHead({ commit, dispatch }, form) {
        try {
            await axios.post('/api/facturacion/head', form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async validarMovimientos({ commit, dispatch }, movimientos) {
        try {
            await axios.post('/api/facturacion/movimientos', { movimientos });
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
    SET_CLIENTES(state, clientes) {
        state.clientes = clientes;
    },
    SET_FORM_CLIENTE_ID(state, cliente_id) {
        state.form.cliente_id = cliente_id
    },
    SET_CONDICION_PAGO_ID(state, condiciones_pago_id) {
        state.form.condiciones_pago_id = condiciones_pago_id
    },
    SET_REMOVED_MOVIMIENTOS(state, movimientosCero) {
        state.removedMovimientos = movimientosCero;
    },
    SET_FORM_MOVIMIENTOS(state, movimientos) {
        state.form.movimientos = movimientos;
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
    SET_FORM_NUMERO_INTERNO(state, numero_interno) {
        state.form.numero_interno = numero_interno
    },
    SET_FORM_NUMERO_FACTURA_1(state, numero_factura_1) {
        state.form.numero_factura_1 = numero_factura_1
    },
    SET_FORM_NUMERO_FACTURA_2(state, numero_factura_2) {
        state.form.numero_factura_2 = numero_factura_2
    },
    SET_CLIENTE(state, cliente) {
        state.cliente = cliente
    },
    SET_CLIENTE_ID_ANTERIOR(state, cliente_id) {
        state.cliente_id_anterior = cliente_id;
    },
    REMOVE_MOVIMIENTO(state, index) {
        const removedItem = state.form.movimientos.splice(index, 1)[0];
        state.removedMovimientos.push(removedItem);
    },
    AGREGAR_MOVIMIENTO(state, index) {
        const restoredItem = state.removedMovimientos.splice(index, 1)[0];
        state.form.movimientos.push(restoredItem);
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
    SET_DISABLED(state, disabled) {
        state.disabled = disabled;
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