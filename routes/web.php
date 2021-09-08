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

Route::resource('/solicitudContrato', 'SolicitudContratoController');
Route::get('/solicitudContratoPdf/{id}', 'SolicitudContratoController@solicitudContratoPdf');
Route::get('/solicitudContratoEnviar/{id}', 'SolicitudContratoController@solicitudContratoEnviar');
Route::get('/solicitudContratoAnular/{id}', 'SolicitudContratoController@solicitudContratoAnular');
Route::get('/solicitudContratoApi/{id}', 'SolicitudContratoController@api');
Route::get('/solicitudContratoAgregarPrestacion', 'SolicitudContratoController@solicitudContratoAgregarPrestacion');

Route::resource('/user', 'UserController');
Route::get('/user/restaurar/{id}', 'UserController@restaurar');

Route::resource('/tipoContrato', 'TipoContratoController');
Route::get('/tipoContratoActivar/{id}', 'TipoContratoController@activar');

Route::resource('/tarifaHonorarioTurno', 'TarifaHonorarioTurnoController');

Route::resource('/tarifaHonorarioSumaAlzada', 'TarifaHonorarioSumaAlzadaController');

Route::resource('/tarifaProgramaChileCrece', 'TarifaProgramaChileCreceController');

Route::resource('/prestacion', 'PrestacionFuncionarioController');

Route::get('/getDatosRut', 'GetController@getDatosRut');
Route::get('/getValor', 'GetController@getValor');
Route::get('/getValorPrestacion', 'GetController@getValorPrestacion');

// Route::resource('/paciente', 'PacienteController');