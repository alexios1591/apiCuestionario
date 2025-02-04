<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuestionarioController;
use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalidadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

