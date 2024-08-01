export const agregarChofer = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/choferes', form);
        dispatch('clearErrors');
        dispatch('getChoferes');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const getChoferes = async ({ commit }) => {
    try {
        const response = await axios.get('/api/choferes');
        commit('SET_CHOFERES', response.data);
    } catch (error) {
        console.error("Error fetching choferes:", error);
    }
};


export const updateErrors = ({ commit }, errors) => {
    commit('SET_ERRORS', errors);
}

export const clearErrors = ({ commit }) => {
    commit('CLEAR_ERRORS');
}