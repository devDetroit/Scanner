<?php

use App\Http\Controllers\ScannerController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('listado', [ScannerController::class, 'listadoIndex']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Escaner

Route::prefix('facilities')->group(function () {
    Route::get('obtener/permiso', [ScannerController::class, 'FacilityPorPermiso']);
});




Route::prefix('scanner')->group(function () {
    Route::get('obtener', [ScannerController::class, 'ObtenerScanners']);
    Route::post('verificar/empleado', [ScannerController::class, 'Checar']);
});
