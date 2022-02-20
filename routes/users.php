<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserLoginController;

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


Route::post('/usuario/login', [UserLoginController::class, 'Userlogin'])->name('Userlogin');
Route::post('/usuario/logout', [UserLoginController::class, 'Userlogout'])->name('Userlogout');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::get('/personal', [UserController::class, 'index']);
    Route::get('/cargos', [UserController::class, 'index']);
    Route::get('/postulaciones', [UserController::class, 'index']);
    Route::get('/usuarios/lista', [UserController::class, 'lista']);
    Route::get('/empresas/lista', [UserController::class, 'listaEmpresas']);
    Route::post('/usuario/ingresar', [UserController::class, 'ingresar']);
    Route::put('/usuario/{id}', [UserController::class, 'actualizar']);


});
