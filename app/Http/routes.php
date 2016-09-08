<?php



Route::get('/', function () {

	return view('index');
});

Route::get('relatorio/view', ['uses' => 'RelatorioController@view']);

Route::auth();

Route::get('/home', ['middleware' => 'auth', function () {
	return view('relatorio.texto'); 
}]);

Route::group(['middleware' => 'auth'], function () {

	Route::group(['as' => 'usuarios.','prefix'=>'usuarios'], function() {

		Route::get('', ['as' => 'index', 'uses' => 'UsuariosController@index']);
		Route::get('criar', ['as' => 'create','uses' => 'UsuariosController@create']);
		Route::post('salvar', ['as' => 'store','uses' => 'UsuariosController@store']);
		Route::get('{id}/visualizar', ['as' => 'show','uses' => 'UsuariosController@show']);
		Route::get('{id}/editar', ['as' => 'edit','uses' => 'UsuariosController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'UsuariosController@update']);
		Route::get('{id}/remover', ['as' => 'destroy','uses' => 'UsuariosController@destroy']);
		
	});

	Route::group(['as' => 'perfil.','prefix'=>'perfil'], function() {

		Route::get('{id}', ['as' => 'index','uses' => 'PerfilController@show']);
		Route::get('/senha', ['as' => 'senha','uses' => 'PerfilController@senha']);
		Route::get('{id}/editar', ['as' => 'edit','uses' => 'PerfilController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'PerfilController@update']);

	});

	Route::group(['as' => 'emails.','prefix'=>'emails'], function() {

		Route::get('', ['as' => 'index','uses' => 'EmailsController@index']);
		Route::get('criar', ['as' => 'create','uses' => 'EmailsController@create']);
		Route::post('salvar', ['as' => 'store', 'uses' => 'EmailsController@store']);
		Route::get('{id}/visualizar', ['as' => 'show','uses' => 'EmailsController@show']);
		Route::get('{id}/editar', ['as' => 'edit', 'uses' => 'EmailsController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'EmailsController@update']);
		Route::get('{id}/remover', ['as' => 'destroy','uses' => 'EmailsController@destroy']);

	});

	Route::group(['as' => 'agencias.','prefix'=>'agencias'], function() {

		Route::get('', ['as' => 'index','uses' => 'AgenciasController@index']);
		Route::get('criar', ['as' => 'create','uses' => 'AgenciasController@create']);
		Route::post('salvar', ['as' => 'store','uses' => 'AgenciasController@store']);
		Route::get('{id}/visualizar', ['as' => 'show','uses' => 'AgenciasController@show']);
		Route::get('{id}/editar', ['as' => 'edit','uses' => 'AgenciasController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'AgenciasController@update']);
		Route::get('{id}/remover', ['as' => 'destroy','uses' => 'AgenciasController@destroy']);

	});

	Route::group(['as' => 'clientes.','prefix'=>'clientes'], function() {

		Route::get('', ['as' => 'index', 'uses' => 'ClientesController@index']);
		Route::get('criar', ['as' => 'create','uses' => 'ClientesController@create']);
		Route::post('salvar', ['as' => 'store','uses' => 'ClientesController@store']);
		Route::get('visualizar', ['as' => 'show','uses' => 'ClientesController@show']);
		Route::get('{id}/editar', ['as' => 'edit','uses' => 'ClientesController@edit']);
		Route::post('{id}/atualizar', ['as' => 'update','uses' => 'ClientesController@update']);
		Route::get('{id}/remover', ['as' => 'destroy','uses' => 'ClientesController@destroy']);
		
	});

	Route::group(['as' => 'relatorio.','prefix'=>'relatorio'], function() {

		Route::get('', ['as' => 'show', 'uses' => 'RelatorioController@show']);
		Route::get('report', ['as' => 'report', 'uses' => 'RelatorioController@report']);
		Route::post('imprimir', ['as' => 'print', 'uses' => 'RelatorioController@print']);
		
	});

});