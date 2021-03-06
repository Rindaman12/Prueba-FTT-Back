<?php

use App\Http\Controllers\PostulacionController;
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




Route::group(['middleware' => 'auth:web'], function () {

    Route::get('/postulaciones/lista', [PostulacionController::class, 'lista']);
    Route::post('/postulaciones/ingresar', [PostulacionController::class, 'ingresar']);
});
