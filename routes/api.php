<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('makePointNow', [App\Http\Controllers\PontoController::class, 'batePonto'])->name('batePonto');
Route::put('updatePoint/{id_ponto}', [App\Http\Controllers\PontoController::class, 'atualizaPonto'])->name('atualizaPonto');
Route::get('TodayPoints', [App\Http\Controllers\PontoController::class, 'getPontosHoje'])->name('getPontosHoje');
Route::get('monthPoints/{mes}', [App\Http\Controllers\PontoController::class, 'getPontosDoMes'])->name('getPontoMes');
Route::post('addPoint', [App\Http\Controllers\PontoController::class, 'addPonto'])->name('addPoint');
