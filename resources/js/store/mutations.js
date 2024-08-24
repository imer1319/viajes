export const SET_CHOFERES = (state, choferes) => {
    state.choferes = choferes
}
export const SET_ANTICIPOS = (state, anticipos) => {
    state.anticipos = anticipos
}
export const SET_GASTOS = (state, gastos) => {
    state.gastos = gastos
}
export const SET_CHOFER = (state, chofer) => {
    state.chofer = chofer
}
export const SET_PROVEEDORES = (state, proveedores) => {
    state.proveedores = proveedores
}
export const SET_MOVIMIENTOS = (state, movimientos) => {
    state.movimientos = movimientos
}
export const SET_FECHA = (state, fecha) => {
    state.form.fecha = fecha;
}
export const SET_CHOFER_ID = (state, chofer_id) => {
    state.form.chofer_id = chofer_id;
}
export const SET_OBSERVACIONES = (state, observaciones) => {
    state.form.observaciones = observaciones;
}
export const SET_NUMERO_INTERNO = (state, numeroInterno) => {
    state.form.numero_interno = numeroInterno;
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
export const SET_CHOFER_ID_ANTERIOR = (state, chofer_id) => {
    state.chofer_id_anterior = chofer_id;
}
export const SET_REMOVED_ITEMS = (state, { removedMovimientos, removedAnticipos, removedGastos }) => {
    state.removedMovimientos = removedMovimientos;
    state.removedAnticipos = removedAnticipos;
    state.removedGastos = removedGastos;
};
export const REMOVE_MOVIMIENTO = (state, index) => {
    const removedItem = state.form.movimientos.splice(index, 1)[0];
    state.removedMovimientos.push(removedItem);
}
export const REMOVE_ANTICIPO = (state, index) => {
    const removedItem = state.form.anticipos.splice(index, 1)[0];
    state.removedAnticipos.push(removedItem);
}
export const REMOVE_GASTO = (state, index) => {
    const removedItem = state.form.gastos.splice(index, 1)[0];
    state.removedGastos.push(removedItem);
}
export const SET_REMOVED_MOVIMIENTOS = (state, movimientos) => {
    state.removedMovimientos = movimientos;
}

export const SET_REMOVED_ANTICIPOS = (state, anticipos) => {
    state.removedAnticipos = anticipos;
}

export const SET_REMOVED_GASTOS = (state, gastos) => {
    state.removedGastos = gastos;
}
export const AGREGAR_MOVIMIENTO = (state, index) => {
    const restoredItem = state.removedMovimientos.splice(index, 1)[0];
    state.form.movimientos.push(restoredItem);
}
export const AGREGAR_ANTICIPO = (state, index) => {
    const restoredItem = state.removedAnticipos.splice(index, 1)[0];
    state.form.anticipos.push(restoredItem);
}
export const AGREGAR_GASTO = (state, index) => {
    const restoredItem = state.removedGastos.splice(index, 1)[0];
    state.form.gastos.push(restoredItem);
}
export const SET_FORM = (state, data) => {
    state.form = data;
}
export const SET_FORM_MOVIMIENTOS = (state, movimientos) => {
    state.form.movimientos = movimientos;
}
export const SET_FORM_ANTICIPOS = (state, anticipos) => {
    state.form.anticipos = anticipos;
}
export const SET_FORM_GASTOS = (state, gastos) => {
    state.form.gastos = gastos;
}
export const SET_IS_EDITING = (state, isEditing) => {
    state.isEditing = isEditing;
}