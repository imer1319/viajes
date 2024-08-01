<?php

use App\Http\Controllers\Api\ChoferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('choferes', [ChoferController::class, 'index'])->name('api.choferes.index');
Route::post('choferes', [ChoferController::class, 'store'])->name('api.choferes.store');