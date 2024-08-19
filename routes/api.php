<?php

use App\Http\Controllers\Api\ChoferController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\FlotaController;
use App\Http\Controllers\Api\LiquidacionController;
use App\Http\Controllers\Api\PlanCuentaController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\TipoViajeController;
use App\Http\Controllers\Main\MovimientoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('flotas', [FlotaController::class, 'index']);
Route::post('flotas', [FlotaController::class, 'store']);
Route::get('choferes', [ChoferController::class, 'index']);
Route::post('choferes', [ChoferController::class, 'store']);
Route::get('clientes', [ClienteController::class, 'index']);
Route::post('clientes', [ClienteController::class, 'store']);
Route::get('tipo-viajes', [TipoViajeController::class, 'index']);
Route::post('tipo-viajes', [TipoViajeController::class, 'store']);
Route::get('proveedores', [ProveedorController::class, 'index']);

Route::get('provincias', [MovimientoController::class, 'provincias']);
Route::get('departamentos/{provincia_id}', [MovimientoController::class, 'departamentosProvincia']);
Route::get('localidades/{departamento_id}', [MovimientoController::class, 'localidadesDepartamento']);

Route::get('retencion-ingreso-brutos', [MovimientoController::class, 'retencionIngresoBrutos']);
Route::get('retencion-ganancias', [MovimientoController::class, 'retencionGanancias']);
Route::get('condiciones-iva', [MovimientoController::class, 'condicionesIva']);
Route::get('tipo-documentos', [MovimientoController::class, 'tipoDocumentos']);
Route::get('plan-cuentas', [PlanCuentaController::class, 'index']);

//Liquidacion
Route::post('/liquidacion/head', [LiquidacionController::class, 'head'])->name('liquidacion.head');
Route::get('movimientos/{chofer}', [MovimientoController::class, 'movimientosChofer']);
Route::post('liquidaciones', [LiquidacionController::class, 'store'])->name('liquidacion.store');
