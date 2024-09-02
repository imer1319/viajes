const state = {
    choferes: [],
    flotas: [],
    tipoViajes: [],
    clientes: [],
    errors: {},
};

const getters = {
    getChoferes: state => state.choferes,
    getFlotas: state => state.flotas,
    getTipoViajes: state => state.tipoViajes,
    getClientes: state => state.clientes,
};

const actions = {
    setChoferes({ commit }, choferes) {
        commit('SET_CHOFERES', choferes);
    },
    setClientes({ commit }, clientes) {
        commit('SET_CLIENTES', clientes);
    },
    setFlotas({ commit }, flotas) {
        commit('SET_FLOTAS', flotas);
    },
    setTipoViajes({ commit }, tipoViajes) {
        commit('SET_TIPO_VIAJES', tipoViajes);
    },
};

const mutations = {
    SET_CHOFERES(state, choferes) {
        state.choferes = choferes;
    },
    SET_CLIENTES(state, clientes) {
        state.clientes = clientes;
    },
    SET_TIPO_VIAJES(state, tipoViajes) {
        state.tipoViajes = tipoViajes;
    },
    SET_FLOTAS(state, flotas) {
        state.flotas = flotas;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};