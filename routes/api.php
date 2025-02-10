<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Cuestionario\CuestionarioController;
use App\Http\Controllers\Cuestionario\LocalidadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Usuario\RolesController;
use App\Http\Controllers\Usuario\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('dashboard', [DashboardController::class, 'getDashboardStats']);

Route::post('cliente', [ClienteController::class, 'store']);
Route::put('cliente', [ClienteController::class, 'update']);

Route::post('login', [LoginController::class, 'login']);
Route::get('getAll', [LoginController::class, 'index']);
Route::post('validate', [CuestionarioController::class, 'validateCode']);

Route::get('departamento', [LocalidadController::class, 'departamento']);
Route::get('provincia/{id}', [LocalidadController::class, 'provincia']);
Route::get('distrito/{id}', [LocalidadController::class, 'distrito']);
Route::get('clientes/export-pdf', [ClienteController::class, 'exportPdf']);
Route::get('clientes/export-excel', [ClienteController::class, 'exportExcel']);
Route::get('clientes/report-questionnaire/{id}', [ClienteController::class, 'reportQuestionnaire']);
Route::get('clientes/unsurveyed', [ClienteController::class, 'getUnsurveyed']);
Route::get('clientes/getall/{id}', [ClienteController::class, 'getAll']);
// Route::get('clientes/{dni}', [ClienteController::class, 'searchByDni']);
Route::get('customers', [ClienteController::class, 'getClientes']);

Route::post('cuestionario', [CuestionarioController::class, 'insert']);
Route::get('cuestionario/{id}', [CuestionarioController::class, 'getById']);

Route::post('usuario', [UsuarioController::class, 'store']);
Route::delete('usuario/{id}', [UsuarioController::class, 'destroy']);
Route::put('usuario/{usuario}', [UsuarioController::class, 'updateProfile']);
Route::get('getAllUser/{id}', [LoginController::class, 'getAllUser']);

Route::get('roles', [RolesController::class, 'getRoles']);
Route::post('roles/{id}', [RolesController::class, 'createRol']);
Route::get('usuario-roles', [RolesController::class, 'getUsuarioRoles']);
Route::delete('roles/{id}/{admiId}', [RolesController::class, 'deleteRol']);