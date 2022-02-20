<?php

use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmpresaAuthController;

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

Route::post('/empresas/crear', [EmpresaAuthController::class, 'registrar']);

Route::post('/empresa/login', [EmpresaAuthController::class, 'Empresalogin'])->name('Empresalogin');
Route::post('/empresa/logout', [EmpresaAuthController::class, 'Empresalogout'])->name('Empresalogout');

Route::group(['middleware' => 'auth:empresas'], function () {
    Route::get('/empresas/inicio', [EmpresaController::class, 'index']);
    Route::get('/empresas/cargos/', [EmpresaController::class, 'listaCargos']);
    Route::post('/postulacion/ingresar', [EmpresaController::class, 'ingresarPostulacion']);
    Route::get('/personal/buscar', [EmpresaController::class, 'buscarPersonal']);
});
