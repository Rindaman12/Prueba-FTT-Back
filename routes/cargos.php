<?php

use App\Http\Controllers\CargoController;
use Illuminate\Support\Facades\Route;
+
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



Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/cargos', [CargoController::class, 'index']);
    Route::get('/cargos/lista', [CargoController::class, 'lista']);
    Route::post('/cargo/ingresar', [CargoController::class, 'ingresar']);
    Route::put('/cargo/{id}', [CargoController::class, 'actualizar']);

});
