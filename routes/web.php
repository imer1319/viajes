<?php

use App\Http\Controllers\Administracion\AnticipoChoferController;
use App\Http\Controllers\Administracion\AnticipoController;
use App\Http\Controllers\Administracion\ChoferController;
use App\Http\Controllers\Administracion\ClienteController;
use App\Http\Controllers\Administracion\GastoChoferController;
use App\Http\Controllers\Administracion\GastoController;
use App\Http\Controllers\Administracion\LiquidacionController;
use App\Http\Controllers\Administracion\ProveedorController;
use App\Http\Controllers\Administracion\UserController;
use App\Http\Controllers\Configuracion\CondicionIvaController;
use App\Http\Controllers\Configuracion\CondicionPagoController;
use App\Http\Controllers\Configuracion\FormaPagoController;
use App\Http\Controllers\Configuracion\MedidaController;
use App\Http\Controllers\Configuracion\RetencionGananciasController;
use App\Http\Controllers\Configuracion\RetencionIngresosBrutoController;
use App\Http\Controllers\Configuracion\TipoComprobanteController;
use App\Http\Controllers\Main\FlotaController;
use App\Http\Controllers\Main\MovimientoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->middleware(['auth'])->group(function () {
    // Configuracion
    Route::resource('retencion-ingresos-bruto', RetencionIngresosBrutoController::class);
    Route::resource('retencion-ganancias', RetencionGananciasController::class);
    Route::resource('tipo-comprobantes', TipoComprobanteController::class);
    Route::resource('forma-pagos', FormaPagoController::class);
    Route::resource('condicion-pagos', CondicionPagoController::class);
    Route::resource('condiciones-iva', CondicionIvaController::class);
    Route::resource('medidas', MedidaController::class);
    // Administracion
    Route::resource('users', UserController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('choferes', ChoferController::class);
    Route::resource('anticipos', AnticipoController::class);
    Route::resource('proveedores', ProveedorController::class);
    // Acciones
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('flotas', FlotaController::class);
    Route::resource('liquidaciones', LiquidacionController::class);
    Route::resource('gastos', GastoController::class);
    // anticipos chofer
    Route::get('anticipos/{chofer}/chofer', [AnticipoChoferController::class, 'index'])->name('anticipos.chofer.index');
    Route::get('anticipos/{chofer}/chofer/create', [AnticipoChoferController::class, 'create'])->name('anticipos.chofer.create');
    Route::get('anticipos/{chofer}/chofer/{anticipo}/edit', [AnticipoChoferController::class, 'edit'])->name('anticipos.chofer.edit');
    // gastos chofer
    Route::get('gastos/{chofer}/chofer', [GastoChoferController::class, 'index'])->name('gastos.chofer.index');
    Route::get('gastos/{chofer}/chofer/create', [GastoChoferController::class, 'create'])->name('gastos.chofer.create');
    Route::get('gastos/{chofer}/chofer/{anticipo}/edit', [GastoChoferController::class, 'edit'])->name('gastos.chofer.edit');
});
