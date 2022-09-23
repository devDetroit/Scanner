<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ScannerController;
use App\Mail\DeliveryMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    Route::get('listado', [ScannerController::class, 'listadoIndex'])->name('listado');


    // scanner
    Route::prefix('scanner')->group(function () {
        Route::get('/', [ScannerController::class, 'index'])->name('scanner.index');
        Route::get('/todo', [ScannerController::class, 'show']);
        Route::post('/agregar', [ScannerController::class, 'store']);
        Route::post('/actualizar', [ScannerController::class, 'update']);
        Route::post('/eliminar', [ScannerController::class, 'delete']);
        Route::get('/todo', [ScannerController::class, 'show']);
        Route::get('/log', [ScannerController::class, 'indexLog'])->name('log');
        Route::get('/log/obtener', [ScannerController::class, 'obtenerLog']);
    });
});

Route::get('test', function () {

    $user = [
        'id' => 1,
        'name' => 'cesarin'
    ];

    /*  foreach($users as $key => $user)

    {

        $email = $user->email; */


    Mail::to('cperez@detroitaxle.com')->send(new DeliveryMail($user));
    dd("success");

    dd("success");
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Escaner

Route::prefix('facilities')->group(function () {
    Route::get('obtener', [ScannerController::class, 'obtener']);
    Route::get('obtener/permiso', [ScannerController::class, 'FacilityPorPermiso']);
});



Route::prefix('delivery')->group(function () {
    Route::get('formulario', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::post('guardar', [DeliveryController::class, 'store']);
});



Route::prefix('scanner')->group(function () {
    Route::get('obtener', [ScannerController::class, 'ObtenerScanners']);
    Route::post('verificar/empleado', [ScannerController::class, 'Checar']);
    Route::get('historial', [ScannerController::class, 'Historial']);
});
