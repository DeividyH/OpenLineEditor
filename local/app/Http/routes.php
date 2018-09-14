<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get('/', 'MainController@index');
  	Route::get('export', 'MainController@exportar');
    Route::get('export/file/{name}', 'ExportaController@exportarArquivo');
    Route::get('export/zip', 'ExportaController@exportarZip');
    Route::get('export/zip/download', 'ExportaController@downloadZip');
  	Route::get('contact', 'MainController@contato');
  	Route::get('login', 'MainController@entrar');

  	Route::get('painel', 'UserPainelController@index');
  	Route::get('painel/lines', 'UserPainelController@allLines');
  	Route::get('painel/tutorial', 'UserPainelController@tutorial');
  	Route::resource('painel/agency', 'EmpresaController');
  	Route::resource('painel/agencies', 'EmpresaController@listar');
  	Route::resource('painel/route', 'LinhaController');
    Route::put('painel/route/unlock/{id}', 'LinhaController@liberar');
    Route::get('painel/route/allTrips/{id}', 'LinhaController@listarTrajetosDaLinha');
    Route::get('painel/route/allStops/{id}', 'LinhaController@listarPontosDaLinha');
  	Route::resource('painel/trip', 'TrajetoController');
  	Route::get('painel/trips/{id}', 'TrajetoController@listByRoute');
  	Route::resource('painel/shape', 'ShapeController');
  	Route::resource('painel/shapes', 'ShapeController@listByTrip');
  	Route::resource('painel/stop', 'StopController');
  	Route::resource('painel/stops', 'StopController@listByTrip');
    Route::resource('painel/stoptimes', 'StopTimesController');
    Route::get('painel/stoptime/{id}', 'StopTimesController@listByStop');

    Route::resource('user', 'UsuarioController');

    Route::resource('login', 'LogController');
    Route::get('logout', 'LogController@logout');
});
