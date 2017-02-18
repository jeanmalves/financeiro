<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/admin', 'HomeController@index');

Route::group(['prefix'=>'admin'], function(){
  Route::get('contas', ['as' => 'conta.index', 'uses' => 'AccountController@index']);
  Route::get('conta/{id}', ['as' => 'conta.get', 'uses' => 'AccountController@get']);
  Route::post('conta', ['as' => 'conta.create', 'uses' => 'AccountController@create']);
  Route::put('conta/{id}', ['as' => 'conta.update', 'uses' => 'AccountController@update']);
  Route::delete('conta/{id}', ['as' => 'conta.delete', 'uses' => 'AccountController@delete']);
});

//
// admin/contas   get   listar
// admin/conta/1  get   recuperar
// admin/conta    post  criar novo
// admin/conta/1  put   atualizar
// admin/conta/1  delete remover

// cada conta a ser cadastrada tem um nome e um saldo(valor de entrada)
