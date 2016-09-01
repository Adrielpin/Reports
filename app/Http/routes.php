<?php

Route::auth();


Route::get('/', function () {
	return view('index');
});

Route::get('/home', ['middleware' => 'auth', function () {
	return view('relatorio.texto');
}]);

/**
 * agencias
 *
 *	Listar
 *	Criar nova
 *	Salvar nova
 *	Editar existente
 *	Atualizar existente
 *	Remover
 *	
 */

Route::group(['middleware' => 'auth'], function () {

	Route::group(['as' => 'agencias.','prefix'=>'agencias'], function() {
		Route::get('', ['as' => 'index','uses' => 'AgenciasController@index']);
		Route::get('criar', ['as' => 'create','uses' => 'AgenciasController@create']);
		Route::post('salvar', ['as' => 'store','uses' => 'AgenciasController@store']);
		Route::get('{id}/visualizar', ['as' => 'show','uses' => 'AgenciasController@show']);
		Route::get('{id}/editar', ['as' => 'edit','uses' => 'AgenciasController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'AgenciasController@update']);
		Route::get('{id}/remover', ['as' => 'destroy','uses' => 'AgenciasController@destroy']);
	});


/**
 * Clientes por agencias
 *
 *	Listar
 *	Criar nova
 *	Salvar nova
 *	Editar existente
 *	Atualizar existente
 *	Remover
 *	
 */

Route::group(['as' => 'clientes.','prefix'=>'clientes'], function() {
	Route::get('', ['as' => 'index', 'uses' => 'ClientesController@index']);
	Route::get('criar', ['as' => 'create','uses' => 'ClientesController@create']);
});

/**
 * 	Relatório
 *	aqui apenas metodos get index and post ajax
 *
 */


Route::group(['as' => 'relatorio.','prefix'=>'relatorio'], function() {
	Route::get('', ['as' => 'index', 'uses' => 'RelatorioController@index']);
	Route::get('report', ['as' => 'report', 'uses' => 'RelatorioController@view']);
});

Route::group(['as' => 'perfil.','prefix'=>'perfil'], function() {
	Route::get('{id}', ['as' => 'index','uses' => 'PerfilController@show']);
	Route::get('{id}/editar', ['as' => 'edit','uses' => 'PerfilController@edit']);
	Route::post('{id}/atualizar', ['as' => 'update','uses' => 'PerfilController@update']);
});


});