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

Route::get('/administracion/usuario/getListadoUsuarios', 'Administracion\UserController@getListadoUsuarios');
Route::post('/administracion/usuario/setRegistrarUsuarios', 'Administracion\UserController@setRegistrarUsuarios');

Route::post('archivo/setRegistrarArchivo','FilesController@setRegistrarArchivo');



Route::get('/{optional?}', function () {
    return view('admin.dashboard');
})->name('basepath')
  ->where('optional','.*');