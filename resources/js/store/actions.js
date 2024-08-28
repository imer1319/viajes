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
export const agregarLiquidacion = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/liquidaciones', form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const actualizarLiquidacion = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/liquidaciones/' + form.id, form);
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
export const agregarAnticipo = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/anticipos', form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const actualizarAnticipo = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/anticipos/' + form.id, form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
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
export const actualizarFlota = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/flotas/' + form.id, form);
        dispatch('clearErrors');
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
export const getProveedores = async ({ commit }) => {
    try {
        const response = await axios.get('/api/proveedores');
        commit('SET_PROVEEDORES', response.data);
    } catch (error) {
        console.error("Error fetching proveedores:", error);
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

export const agregarGasto = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/gastos', form);
        dispatch('clearErrors');
        dispatch('getGasto');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const actualizarGasto = async ({ commit, dispatch }, form) => {
    try {
        await axios.put('/gastos/' + form.id, form);
        dispatch('clearErrors');
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
export const getMovimientosChofer = async ({ commit, state }, chofer_id) => {
    try {
        const response = await axios.get(`/api/movimientos/${chofer_id}?edit=${state.isEditing}&chofer_id_anterior=${state.chofer_id_anterior}&liquidacion=${state.form.id}`);
        const choferData = response.data.chofer;
        const movimientos = response.data.movimientos;
        const anticipos = response.data.anticipos;
        const gastos = response.data.gastos;
        console.log(response.data);
        commit('SET_CHOFER', choferData);

        if (state.isEditing) {
            commit('SET_FORM_MOVIMIENTOS', movimientos);
            commit('SET_FORM_ANTICIPOS', anticipos);
            commit('SET_FORM_GASTOS', gastos);
            commit('SET_REMOVED_ITEMS', {
                removedMovimientos: response.data.movimientosCero || [],
                removedAnticipos: response.data.anticiposCero || [],
                removedGastos: response.data.gastosCero || [],
            });
        } else {
            commit('SET_FORM_MOVIMIENTOS', movimientos);
            commit('SET_FORM_ANTICIPOS', anticipos);
            commit('SET_FORM_GASTOS', gastos);
        }
    } catch (error) {
        console.error("Error al traer los movimientos del chofer:", error);
    }
};

export const getMovimientosCliente = async ({ commit, state }, cliente_id) => {
    try {
        const response = await axios.get(`/api/movimientos/${cliente_id}?edit=${state.isEditing}&cliente_id_anterior=${state.cliente_id_anterior}&recibo=${state.form.id}`);
        const clienteData = response.data.chofer;
        const movimientos = response.data.movimientos;
        const anticipos = response.data.anticipos;
        const gastos = response.data.gastos;
        console.log(response.data);
        commit('SET_CHOFER', clienteData);

        if (state.isEditing) {
            commit('SET_FORM_MOVIMIENTOS', movimientos);
            commit('SET_FORM_ANTICIPOS', anticipos);
            commit('SET_FORM_GASTOS', gastos);
            commit('SET_REMOVED_ITEMS', {
                removedMovimientos: response.data.movimientosCero || [],
                removedAnticipos: response.data.anticiposCero || [],
                removedGastos: response.data.gastosCero || [],
            });
        } else {
            commit('SET_FORM_MOVIMIENTOS', movimientos);
            commit('SET_FORM_ANTICIPOS', anticipos);
            commit('SET_FORM_GASTOS', gastos);
        }
    } catch (error) {
        console.error("Error al traer los movimientos del chofer:", error);
    }
};
export const validarHead = async ({ commit, dispatch }, form) => {
    try {
        await axios.post('/api/liquidacion/head', form);
        dispatch('clearErrors');
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            commit('SET_ERRORS', error.response.data.errors);
        }
        throw error;
    }
};
export const updateFecha = ({ commit }, fecha) => {
    commit('SET_FECHA', fecha);
}
export const updateChoferId = ({ commit }, chofer_id) => {
    commit('SET_CHOFER_ID', chofer_id);
}
export const updateObservaciones = ({ commit }, observaciones) => {
    commit('SET_OBSERVACIONES', observaciones);
}
export const setForm = ({ commit }, formData) => {
    commit('SET_FORM', formData);
}