<?php

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
Route::get('/registrarEmp', function () {
    return view('welcome');
});

Route::get('/loginUser', function () {
    return view('welcome');
})->name('login');

Route::get('/loginEmp', function () {
    return view('welcome');
});
