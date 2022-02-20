<?php

use App\Http\Controllers\PersonalController;
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
    Route::get('/personal', [PersonalController::class, 'index']);
    Route::get('/personals/lista', [PersonalController::class, 'lista']);
    Route::post('/personal/ingresar', [PersonalController::class, 'ingresar']);
    Route::delete('/personal/{id}', [PersonalController::class, 'eliminar']);
    Route::put('/personal/{id}', [PersonalController::class, 'actualizar']);


});
