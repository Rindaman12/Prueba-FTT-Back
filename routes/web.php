<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Archivo de rutas de Welcome

Route::group([], __DIR__ . '/welcome.php');

//Archivo de rutas de Empresas

Route::group([], __DIR__ . '/empresas.php');

//Archivo de rutas de Admins

Route::group([], __DIR__ . '/users.php');

//Archivo de rutas de personals

Route::group([], __DIR__ . '/personals.php');

//Archivo de rutas de cargos

Route::group([], __DIR__ . '/cargos.php');

//Archivo de rutas de postulaciones

Route::group([], __DIR__ . '/postulaciones.php');


