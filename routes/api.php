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
    Route::get('sector/fill/{params}', 'SectorController@fill')->middleware('permission:listar');
    Route::get('sector', 'SectorController@index')->middleware('permission:listar');
    Route::post('sector', 'SectorController@store')->middleware('permission:registrar');
    Route::put('sector/{id}', 'SectorController@update')->middleware('permission:editar');
    Route::delete('sector/{id}', 'SectorController@destroy')->middleware('permission:eliminar');

    Route::get('lugar/fill/{params}', 'LugarController@fill')->middleware('permission:listar');
    Route::get('lugar', 'LugarController@index')->middleware('permission:listar');
    Route::post('lugar', 'LugarController@store')->middleware('permission:registrar');
    Route::put('lugar/{id}', 'LugarController@update')->middleware('permission:editar');
    Route::delete('lugar/{id}', 'LugarController@destroy')->middleware('permission:eliminar');

    Route::get('delegado/fill/{params}', 'DelegadoController@fill')->middleware('permission:listar');
    Route::get('delegado', 'DelegadoController@index')->middleware('permission:listar');
    Route::post('delegado', 'DelegadoController@store')->middleware('permission:registrar');
    Route::put('delegado/{id}', 'DelegadoController@update')->middleware('permission:editar');
    Route::delete('delegado/{id}', 'DelegadoController@destroy')->middleware('permission:eliminar');
});

