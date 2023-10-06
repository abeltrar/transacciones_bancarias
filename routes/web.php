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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/listadoUsuarios', [App\Http\Controllers\UsuariosController::class, 'listadoUsuarios'])->name('listadoUsuarios');
Route::get('/verUsuario', [App\Http\Controllers\UsuariosController::class, 'verUsuario'])->name('verUsuario');
Route::get('/CreaCarrera', [App\Http\Controllers\CarrerasController::class, 'crearCarrera'])->name('CreaCarrera');
Route::get('/listarcarrera', [App\Http\Controllers\CarrerasController::class, 'listarcarrera'])->name('listarcarrera');
Route::post('/AddCarrera', [App\Http\Controllers\CarrerasController::class, 'AddCarrera'])->name('AddCarrera');
Route::get('/CrearUsuarioV', [App\Http\Controllers\UsuariosController::class, 'CrearUsuarioV'])->name('CrearUsuarioV');
Route::post('/store', [App\Http\Controllers\UsuariosController::class, 'store'])->name('store');
Route::get('/UpdateCarrera', [App\Http\Controllers\CarrerasController::class, 'UpdateCarrera'])->name('UpdateCarrera');
Route::put('/editCarrera', [App\Http\Controllers\CarrerasController::class, 'editCarrera'])->name('editCarrera');
Route::delete('/delete', [App\Http\Controllers\CarrerasController::class, 'delete'])->name('delete');
Route::get('/udpateUsuario', [App\Http\Controllers\UsuariosController::class, 'udpateUsuario'])->name('udpateUsuario');
Route::put('/editUsuario', [App\Http\Controllers\UsuariosController::class, 'editUsuario'])->name('editUsuario');
Route::delete('/deleteUser', [App\Http\Controllers\UsuariosController::class, 'deleteUser'])->name('deleteUser');
Route::get('/moduloTransacciones', [App\Http\Controllers\transaccionesController::class, 'moduloTransacciones'])->name('moduloTransacciones');
Route::post('/recargarCuenta', [App\Http\Controllers\transaccionesController::class, 'recargarCuenta'])->name('recargarCuenta');
Route::post('/verCuenta', [App\Http\Controllers\transaccionesController::class, 'verCuenta'])->name('verCuenta');
Route::post('/pagarCuenta', [App\Http\Controllers\transaccionesController::class, 'pagarCuenta'])->name('pagarCuenta');
Route::post('/enviartoken', [App\Http\Controllers\transaccionesController::class, 'enviartoken'])->name('enviartoken');
Route::post('/enviarpago', [App\Http\Controllers\transaccionesController::class, 'enviarpago'])->name('enviarpago');
