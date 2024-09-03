const state = {
    chofer: {},
    isEditing: false,
    chofer_id_anterior: null,
    form: {
        id: "",
        fecha: "",
        chofer_id: "",
        numero_interno: "",
        observaciones: "",
        total_liquidacion: "",
        movimientos: [],
        gastos: [],
        anticipos: [],
    },
    removedMovimientos: [],
    removedAnticipos: [],
    removedGastos: [],
    choferes: [],
    errors: {},
};

const getters = {

};

const actions = {
    getErrorMessage({ commit }, error) {
        return Array.isArray(error) ? error[0] : error;
    },
    async getMovimientosChofer({ commit, state }, chofer_id) {
        try {
            const response = await axios.get(`/api/liquidacion/${chofer_id}?edit=${state.isEditing}&chofer_id_anterior=${state.chofer_id_anterior}&liquidacion=${state.form.id}`);
            const choferData = response.data.chofer;
            const movimientos = response.data.movimientos;
            const anticipos = response.data.anticipos;
            const gastos = response.data.gastos;
            commit('SET_CHOFER', choferData);

            if (state.isEditing) {
                commit('SET_FORM_MOVIMIENTOS', movimientos);
                commit('SET_FORM_ANTICIPOS', anticipos);
                commit('SET_FORM_GASTOS', gastos);
                commit('SET_REMOVED_MOVIMIENTOS', response.data.movimientosCero);
                commit('SET_REMOVED_ANTICIPOS', response.data.anticiposCero);
                commit('SET_REMOVED_GASTOS', response.data.gastosCero);
            } else {
                commit('SET_FORM_MOVIMIENTOS', movimientos);
                commit('SET_FORM_ANTICIPOS', anticipos);
                commit('SET_FORM_GASTOS', gastos);
            }
        } catch (error) {
            console.error("Error al traer los movimientos del chofer:", error);
        }
    },
    async validarHead({ commit, dispatch }, form) {
        try {
            await axios.post('/api/liquidacion/head', form);
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
            await axios.post('/api/liquidacion/movimientos', { movimientos });
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async validarAnticipos({ commit, dispatch }, anticipos) {
        try {
            await axios.post('/api/liquidacion/anticipos', { anticipos });
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async validarGastos({ commit, dispatch }, gastos) {
        try {
            await axios.post('/api/liquidacion/gastos', { gastos });
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async agregarLiquidacion({ commit, dispatch }, form) {
        try {
            await axios.post('/api/liquidaciones', form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
    },
    async actualizarLiquidacion({ commit, dispatch }, form) {
        try {
            await axios.put('/api/liquidaciones/' + form.id, form);
            dispatch('clearErrors');
        } catch (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                commit('SET_ERRORS', error.response.data.errors);
            }
            throw error;
        }
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
    setChoferes({ commit }, choferes) {
        commit('SET_CHOFERES', choferes);
    },
};

const mutations = {
    SET_REMOVED_MOVIMIENTOS(state, movimientosCero) {
        state.removedMovimientos = movimientosCero;
    },
    SET_REMOVED_ANTICIPOS(state, anticiposCero) {
        state.removedAnticipos = anticiposCero;
    },
    SET_REMOVED_GASTOS(state, gastosCero) {
        state.removedGastos = gastosCero;
    },
    SET_FORM_MOVIMIENTOS(state, movimientos) {
        state.form.movimientos = movimientos;
    },
    SET_FORM_ANTICIPOS(state, anticipos) {
        state.form.anticipos = anticipos;
    },
    SET_FORM_GASTOS(state, gastos) {
        state.form.gastos = gastos;
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
    SET_CHOFER(state, chofer) {
        state.chofer = chofer
    },
    SET_CHOFER_ID_ANTERIOR(state, chofer_id) {
        state.chofer_id_anterior = chofer_id;
    },
    REMOVE_MOVIMIENTO(state, index) {
        const removedItem = state.form.movimientos.splice(index, 1)[0];
        state.removedMovimientos.push(removedItem);
    },
    REMOVE_ANTICIPO(state, index) {
        const removedItem = state.form.anticipos.splice(index, 1)[0];
        state.removedAnticipos.push(removedItem);
    },
    REMOVE_GASTO(state, index) {
        const removedItem = state.form.gastos.splice(index, 1)[0];
        state.removedGastos.push(removedItem);
    },
    AGREGAR_MOVIMIENTO(state, index) {
        const restoredItem = state.removedMovimientos.splice(index, 1)[0];
        state.form.movimientos.push(restoredItem);
    },
    AGREGAR_ANTICIPO(state, index) {
        const restoredItem = state.removedAnticipos.splice(index, 1)[0];
        state.form.anticipos.push(restoredItem);
    },
    AGREGAR_GASTO(state, index) {
        const restoredItem = state.removedGastos.splice(index, 1)[0];
        state.form.gastos.push(restoredItem);
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
    SET_CHOFERES(state, choferes) {
        state.choferes = choferes;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};