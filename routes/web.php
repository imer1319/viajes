<?php

use App\Http\Controllers\Administracion\AnticipoChoferController;
use App\Http\Controllers\Administracion\AnticipoController;
use App\Http\Controllers\Administracion\ChoferController;
use App\Http\Controllers\Administracion\ClienteController;
use App\Http\Controllers\Administracion\GastoChoferController;
use App\Http\Controllers\Administracion\GastoController;
use App\Http\Controllers\Administracion\LiquidacionController;
use App\Http\Controllers\Administracion\ProveedorController;
use App\Http\Controllers\Administracion\ReciboController;
use App\Http\Controllers\Administracion\UserController;
use App\Http\Controllers\Configuracion\BancoController;
use App\Http\Controllers\Configuracion\CondicionIvaController;
use App\Http\Controllers\Configuracion\CondicionPagoController;
use App\Http\Controllers\Configuracion\FormaPagoController;
use App\Http\Controllers\Configuracion\MedidaController;
use App\Http\Controllers\Configuracion\RetencionGananciasController;
use App\Http\Controllers\Configuracion\RetencionIngresosBrutoController;
use App\Http\Controllers\Configuracion\TipoComprobanteController;
use App\Http\Controllers\Main\FacturacionController;
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
    Route::resource('bancos', BancoController::class);
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
    Route::resource('recibos', ReciboController::class);
    Route::resource('facturaciones', FacturacionController::class);
    // anticipos chofer
    Route::get('anticipos/{chofer}/chofer', [AnticipoChoferController::class, 'index'])->name('anticipos.chofer.index');
    Route::get('anticipos/{chofer}/chofer/create', [AnticipoChoferController::class, 'create'])->name('anticipos.chofer.create');
    Route::get('anticipos/{chofer}/chofer/{anticipo}/edit', [AnticipoChoferController::class, 'edit'])->name('anticipos.chofer.edit');
    // gastos chofer
    Route::get('gastos/{chofer}/chofer', [GastoChoferController::class, 'index'])->name('gastos.chofer.index');
    Route::get('gastos/{chofer}/chofer/create', [GastoChoferController::class, 'create'])->name('gastos.chofer.create');
    Route::get('gastos/{chofer}/chofer/{gasto}/edit', [GastoChoferController::class, 'edit'])->name('gastos.chofer.edit');
    Route::get('gastos/{chofer}/chofer/{gasto}/show', [GastoChoferController::class, 'show'])->name('gastos.chofer.show');

    // PDF
    Route::get('liquidacion/{liquidacion}/download', [LiquidacionController::class, 'downloadPdf'])->name('liquidacion.download.pdf');
    Route::get('/movimientos/{movimiento}/pdf/export', [MovimientoController::class, 'downloadPdf'])->name('movimiento.download.pdf');
    Route::get('/facturas/{factura}/pdf/export', [FacturacionController::class, 'downloadPdf'])->name('factura.download.pdf');
    Route::get('/recibos/{recibo}/pdf/export', [ReciboController::class, 'downloadPdf'])->name('recibo.download.pdf');
    // EXPORT EXCEL
    Route::get('/movimientos/excel/export', [MovimientoController::class, 'downloadExcel'])->name('movimiento.download.excel');
    Route::get('/liquidaciones/excel/export', [LiquidacionController::class, 'downloadExcel'])->name('liquidacion.download.excel');
    Route::get('/recibos/excel/export', [ReciboController::class, 'downloadExcel'])->name('recibo.download.excel');
    Route::get('/gastos/excel/export', [GastoController::class, 'downloadExcel'])->name('gastos.download.excel');
    Route::get('/gastos/{chofer}/excel/export', [GastoChoferController::class, 'downloadExcel'])->name('gastos.chofer.download.excel');
    Route::get('/anticipos/excel/export', [AnticipoController::class, 'downloadExcel'])->name('anticipos.download.excel');
    Route::get('/anticipos/{chofer}/excel/export', [AnticipoChoferController::class, 'downloadExcel'])->name('anticipos.chofer.download.excel');
    Route::get('/choferes/excel/export', [ChoferController::class, 'downloadExcel'])->name('choferes.download.excel');
    Route::get('/clientes/excel/export', [ClienteController::class, 'downloadExcel'])->name('clientes.download.excel');
    Route::get('/facturas/excel/export', [FacturacionController::class, 'downloadExcel'])->name('facturas.download.excel');
    //search
    Route::get('movimiento/search', [MovimientoController::class, 'search'])->name('movimientos.search');
    Route::get('factura/search', [FacturacionController::class, 'search'])->name('facturaciones.search');
    Route::get('recibo/search', [ReciboController::class, 'search'])->name('recibos.search');
    Route::get('anticipo/search', [AnticipoController::class, 'search'])->name('anticipos.search');
    Route::get('anticipo/chofer/search/{chofer}', [AnticipoChoferController::class, 'search'])->name('anticipos.chofer.search');
});
