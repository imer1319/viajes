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
        saldo_total: "",
        total_recibo: "",
        facturas: [],
        formaPagos: []
    },
    form_pago: {
        id: '',
        forma_pago_id: '',
        banco_id: '',
        numero: '',
        importe: '',
        fecha_emision: '',
        fecha_vencimiento: '',
        abreviacion: '',
        descripcion: ''
    },
    monto_faltante: '',
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
    async validarFormaPago({ commit, state, dispatch }, formPago) {
        try {
            const data = {
                form_pago: formPago,
                monto_faltante: state.monto_faltante,
            };
            await axios.post('/api/recibos/formaPago', data);
            dispatch('clearErrors');
            commit('AGREGAR_FORMA_PAGO');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async validarFormaPagos({ commit, state, dispatch }) {
        try {
            const data = {
                formaPagos: state.form.formaPagos,
                monto_faltante: state.monto_faltante,
            };
            await axios.post('/api/recibos/formaPagos', data);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async agregarRecibo({ commit, dispatch }, form) {
        try {
            await axios.post('/api/recibos', form);
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
    AGREGAR_FORMA_PAGO(state) {
        const importe = parseFloat(state.form_pago.importe || 0);
        state.form.formaPagos.push({ ...state.form_pago });
        state.monto_faltante -= importe;
        state.form_pago = {
            id: '',
            forma_pago_id: '',
            banco_id: '',
            importe: '',
            fecha_emision: '',
            fecha_vencimiento: '',
            abreviacion: '',
            descripcion: '',
        };
    },
    ELIMINAR_FORMA_PAGO(state, index) {
        const importe = parseFloat(state.form.formaPagos[index].importe || 0);
        state.form.formaPagos.splice(index, 1);
        state.monto_faltante += importe;
    },
    CLEAR_FORM_PAGO(state) {
        state.form_pago = {
            id: '',
            forma_pago_id: '',
            banco_id: '',
            importe: '',
            fecha_emision: '',
            fecha_vencimiento: '',
        };
    },
    SET_FORM_PAGO(state, payload) {
        state.form_pago = { ...state.form_pago, ...payload };
    },
    SET_PAGO_FORMA_PAGO_ID(state, forma_pago_id) {
        state.form_pago.forma_pago_id = forma_pago_id;
    },
    SET_MONTO_FALTANTE(state, monto_faltante) {
        state.monto_faltante = monto_faltante;
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
    SET_FORM_TOTAL_RECIBO(state, total_recibo) {
        state.form.total_recibo = total_recibo;
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