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
    return redirect('/solicitudContrato');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/solicitudContrato', 'SolicitudContratoController');
Route::get('/solicitudContratoPdf/{id}', 'SolicitudContratoController@solicitudContratoPdf');
Route::get('/solicitudContratoEnviar/{id}', 'SolicitudContratoController@solicitudContratoEnviar');
Route::get('/solicitudContratoAnular/{id}', 'SolicitudContratoController@solicitudContratoAnular');
Route::get('/solicitudContratoAgregarPrestacion', 'SolicitudContratoController@solicitudContratoAgregarPrestacion');

Route::resource('/user', 'UserController');

Route::resource('/tipoContrato', 'TipoContratoController');

Route::resource('/rango', 'RangoController');

Route::get('/getDatosRut', 'GetController@getDatosRut');
Route::get('/getValor', 'GetController@getValor');
Route::get('/getValorPrestacion', 'GetController@getValorPrestacion');