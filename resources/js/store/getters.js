export const getErrors = state => state.errors
export const getFlotas = state => state.flotas
export const getChoferes = state => state.choferes
export const getTipoViajes = state => state.tipoViajes
export const getClientes = state => state.clientes
export const getProvincias = state => state.provincias;
export const getDepartamentos = state => state.departamentos;
export const getLocalidades = state => state.localidades;
export const getRetencionGanancias = state => state.retencionGanancias;
export const getCondicionesIva = state => state.condicionesIva;
export const getTipoDocumentos = state => state.tipoDocumentos;
export const getRetencionIngresoBrutos = state => state.retencionIngresoBrutos;
export const getPlanCuentas = state => state.planCuentas;
export const getMovimientos = state => state.movimientos;
export const getAnticipos = state => state.anticipos;
export const getGastos = state => state.gastos;
export const getChofer = state => state.chofer;
export const getProveedores = state => state.proveedores;

export const getForm = state => state.form
export const formFecha = state => state.form.fecha
export const formChoferId = state => state.form.chofer_id
export const formObservaciones = state => state.form.observaciones
export const formNumeroInterno = state => state.form.numero_interno

export const getRemovedMovimientos = state => state.removedMovimientos
export const getRemovedAnticipos = state => state.removedAnticipos
export const getRemovedGastos = state => state.removedGastos