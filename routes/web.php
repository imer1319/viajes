<?php

use App\Http\Controllers\configuracion\RetencionGananciasController;
use App\Http\Controllers\configuracion\RetencionIngresosBrutoController;
use App\Http\Controllers\Main\MovimientoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('retencion-ingresos-bruto', RetencionIngresosBrutoController::class);
    Route::resource('retencion-ganancias', RetencionGananciasController::class);
    Route::resource('movimientos', MovimientoController::class);
});
