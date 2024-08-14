export const SET_CHOFERES = (state, choferes) => {
    state.choferes = choferes
}
export const SET_CHOFER = (state, chofer) => {
    state.chofer = chofer
}
export const SET_MOVIMIENTOS = (state, movimientos) => {
    state.movimientos = movimientos
}
export const SET_CHOFER_ID = (state, chofer_id) => {
    state.chofer_id = chofer_id
}
export const SET_PLAN_CUENTAS = (state, planCuentas) => {
    state.planCuentas = planCuentas
}
export const SET_FLOTAS = (state, flotas) => {
    state.flotas = flotas
}
export const SET_CLIENTES = (state, clientes) => {
    state.clientes = clientes
}
export const SET_TIPO_VIAJES = (state, tipoViajes) => {
    state.tipoViajes = tipoViajes
}
export const SET_CONDICIONES_IVA = (state, condicionesIva) => {
    state.condicionesIva = condicionesIva
}

export const SET_PROVINCIAS = (state, provincias) => {
    state.provincias = provincias
}
export const SET_DEPARTAMENTOS = (state, departamentos) => {
    state.departamentos = departamentos
}
export const SET_LOCALIDADES = (state, localidades) => {
    state.localidades = localidades
}

export const SET_TIPO_DOCUMENTOS = (state, tipoDocumentos) => {
    state.tipoDocumentos = tipoDocumentos
}
export const SET_RETENCION_GANANCIAS = (state, retencionGanancias) => {
    state.retencionGanancias = retencionGanancias
}
export const SET_RETENCION_INGRESO_BRUTOS = (state, retencionIngresoBrutos) => {
    state.retencionIngresoBrutos = retencionIngresoBrutos
}

export const SET_ERRORS = (state, errors) => {
    state.errors = errors;
};
export const CLEAR_ERRORS = (state) => {
    state.errors = {};
};