<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['guest:api']], function() {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('login/refresh', 'Auth\LoginController@refresh');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => ['jwt']], function() {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('me', 'Auth\LoginController@me');
    Route::put('profile', 'ProfileController@update');

    Route::apiResource('ciudad', 'CiudadController');
    Route::get('ciudad/fill/{param}', 'CiudadController@fill');

    Route::apiResource('persona', 'PersonaController');
    Route::get('persona/fill/{param}', 'PersonaController@fill');

    Route::apiResource('hobby', 'HobbyController');
    Route::get('hobby/fill/{param}', 'HobbyController@fill');

    Route::apiResource('habilidad', 'HabilidadController');
    Route::get('habilidad/fill/{param}', 'HabilidadController@fill');

    Route::apiResource('contacto', 'ContactoController');
    Route::get('contacto/fill/{param}', 'ContactoController@fill');

    Route::apiResource('formacion_academica', 'FormacionAcademicaaController');
    Route::get('formacion_academica/fill/{param}', 'FormacionAcademicaaController@fill');

    Route::apiResource('idioma', 'IdiomaController');
    Route::get('idioma/fill/{param}', 'IdiomaController@fill');

    Route::apiResource('referencia_laboral', 'ReferenciaLaboralController');
    Route::get('referencia_laboral/fill/{param}', 'ReferenciaLaboralController@fill');

    Route::apiResource('software_manipulable', 'SoftwareManipulableController');
    Route::get('software_manipulable/fill/{param}', 'SoftwareManipulableController@fill');

    Route::apiResource('experiencia_laboral', 'ExperienciaLaboralController');
    Route::get('experiencia_laboral/fill/{param}', 'ExperienciaLaboralController@fill');

    Route::apiResource('tarea_realizada', 'TareaRealizadaController');
    Route::get('tarea_realizada/fill/{param}', 'TareaRealizadaController@fill');
});

