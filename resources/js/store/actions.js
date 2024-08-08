export const agregarMovimiento = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/movimientos', form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const actualizarMovimiento = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/movimientos/' + form.id, form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
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
export const actualizarChofer = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/choferes/' + form.id, form);
        dispatch('clearErrors');
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

export const agregarFlota = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/flotas', form);
        dispatch('clearErrors');
        dispatch('getFlotas');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const getFlotas = async ({ commit }) => {
    try {
        const response = await axios.get('/api/flotas');
        commit('SET_FLOTAS', response.data);
    } catch (error) {
        console.error("Error fetching flotas:", error);
    }
};

export const agregarCliente = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/clientes', form);
        dispatch('clearErrors');
        dispatch('getClientes');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const agregarProveedor = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/proveedores', form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const actualizarProveedor = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/proveedores/' + form.id, form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const actualizarCliente = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/clientes/' + form.id, form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const getClientes = async ({ commit }) => {
    try {
        const response = await axios.get('/api/clientes');
        commit('SET_CLIENTES', response.data);
    } catch (error) {
        console.error("Error fetching clientes:", error);
    }
};
export const getPlanCuentas = async ({ commit }) => {
    try {
        const response = await axios.get('/api/plan-cuentas');
        commit('SET_PLAN_CUENTAS', response.data);
    } catch (error) {
        console.error("Error fetching plan de cuentas:", error);
    }
};

export const agregarTipoViaje = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/tipo-viajes', form);
        dispatch('clearErrors');
        dispatch('getTipoViajes');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};

export const getTipoViajes = async ({ commit }) => {
    try {
        const response = await axios.get('/api/tipo-viajes');
        commit('SET_TIPO_VIAJES', response.data);
    } catch (error) {
        console.error("Error fetching tipo viajes:", error);
    }
};

export const updateErrors = ({ commit }, errors) => {
    commit('SET_ERRORS', errors);
}

export const clearErrors = ({ commit }) => {
    commit('CLEAR_ERRORS');
}

export const getRetencionGanancias = async ({ commit }) => {
    try {
        const response = await axios.get('/api/retencion-ganancias');
        commit('SET_RETENCION_GANANCIAS', response.data);
    } catch (error) {
        console.error("Error al traer a las retenciones de ganancias:", error);
    }
};
export const getRetencionIngresoBrutos = async ({ commit }) => {
    try {
        const response = await axios.get('/api/retencion-ingreso-brutos');
        commit('SET_RETENCION_INGRESO_BRUTOS', response.data);
    } catch (error) {
        console.error("Error al traer a las retenciones de ingresos gruto:", error);
    }
};
export const getCondicionesIva = async ({ commit }) => {
    try {
        const response = await axios.get('/api/condiciones-iva');
        commit('SET_CONDICIONES_IVA', response.data);
    } catch (error) {
        console.error("Error al traer a las condiciones iva:", error);
    }
};
export const getTipoDocumentos = async ({ commit }) => {
    try {
        const response = await axios.get('/api/tipo-documentos');
        commit('SET_TIPO_DOCUMENTOS', response.data);
    } catch (error) {
        console.error("Error al traer a los tipos de documentos:", error);
    }
};
export const getProvincias = async ({ commit }) => {
    try {
        const response = await axios.get('/api/provincias');
        commit('SET_PROVINCIAS', response.data);
    } catch (error) {
        console.error("Error al traer a las provincias:", error);
    }
};
export const getDepartamentosProvincia = async ({ commit }, provincia_id) => {
    try {
        const response = await axios.get('/api/departamentos/' + provincia_id);
        commit('SET_DEPARTAMENTOS', response.data);
    } catch (error) {
        console.error("Error al traer a los departamentos:", error);
    }
};
export const getLocalidadesDepartamento = async ({ commit }, departamento_id) => {
    try {
        const response = await axios.get('/api/localidades/' + departamento_id);
        commit('SET_LOCALIDADES', response.data);
    } catch (error) {
        console.error("Error al traer a las localidades:", error);
    }
};