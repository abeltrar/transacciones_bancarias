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
Route::get('/CrearUsuarioV', [App\Http\Controllers\UsuariosController::class, 'CrearUsuarioV'])->name('CrearUsuarioV');
Route::post('/store', [App\Http\Controllers\UsuariosController::class, 'store'])->name('store');
Route::get('/udpateUsuario', [App\Http\Controllers\UsuariosController::class, 'udpateUsuario'])->name('udpateUsuario');
Route::put('/editUsuario', [App\Http\Controllers\UsuariosController::class, 'editUsuario'])->name('editUsuario');
Route::delete('/deleteUser', [App\Http\Controllers\UsuariosController::class, 'deleteUser'])->name('deleteUser');
Route::get('/moduloTransacciones', [App\Http\Controllers\transaccionesController::class, 'moduloTransacciones'])->name('moduloTransacciones');
Route::post('/recargarCuenta', [App\Http\Controllers\transaccionesController::class, 'recargarCuenta'])->name('recargarCuenta');
Route::post('/verCuenta', [App\Http\Controllers\transaccionesController::class, 'verCuenta'])->name('verCuenta');
Route::post('/pagarCuenta', [App\Http\Controllers\transaccionesController::class, 'pagarCuenta'])->name('pagarCuenta');
Route::post('/enviartoken', [App\Http\Controllers\transaccionesController::class, 'enviartoken'])->name('enviartoken');
Route::post('/enviarpago', [App\Http\Controllers\transaccionesController::class, 'enviarpago'])->name('enviarpago');
Route::get('/createCuentaVer', [App\Http\Controllers\transaccionesController::class, 'createCuentaVer'])->name('createCuentaVer');
Route::post('/createCuenta', [App\Http\Controllers\transaccionesController::class, 'createCuenta'])->name('createCuenta');
