<?php
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\SaidasController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\ClientessController;
use App\Http\Controllers\TipoEntradasController;
use App\Http\Controllers\TipoSaidasController;
use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix'=>'testes', 'where'=>['id'=>'[0-9]+']], function() {
        Route::get('getIndex',       ['as'=>'teste.getIndex',  'uses'=>'CepController@create' ]);
    });

    Route::group(['prefix'=>'clientes', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'clientes',         'uses'=>'ClientesController@index'  ]);
        Route::get('create',       ['as'=>'clientes.create',  'uses'=>'ClientesController@create' ]);
        Route::get('{id}/destroy', ['as'=>'clientes.destroy', 'uses'=>'ClientesController@destroy']);
        Route::get('edit',         ['as'=>'clientes.edit',    'uses'=>'ClientesController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'clientes.update',  'uses'=>'ClientesController@update' ]);
        Route::post('store',       ['as'=>'clientes.store',   'uses'=>'ClientesController@store'  ]);
    });

    Route::group(['prefix'=>'produtos', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'produtos',         'uses'=>'ProdutosController@index'  ]);
        Route::get('create',       ['as'=>'produtos.create',  'uses'=>'ProdutosController@create' ]);
        Route::get('{id}/destroy', ['as'=>'produtos.destroy', 'uses'=>'ProdutosController@destroy']);
        Route::get('edit',         ['as'=>'produtos.edit',    'uses'=>'ProdutosController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'produtos.update',  'uses'=>'ProdutosController@update' ]);
        Route::post('store',       ['as'=>'produtos.store',   'uses'=>'ProdutosController@store'  ]);
    });

    Route::group(['prefix'=>'entradas', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'entradas',         'uses'=>'EntradasController@index'  ]);
        Route::get('create',       ['as'=>'entradas.create',  'uses'=>'EntradasController@create' ]);
        Route::get('{id}/destroy', ['as'=>'entradas.destroy', 'uses'=>'EntradasController@destroy']);
        Route::get('edit',         ['as'=>'entradas.edit',    'uses'=>'EntradasController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'entradas.update',  'uses'=>'EntradasController@update' ]);
        Route::post('store',       ['as'=>'entradas.store',   'uses'=>'EntradasController@store'  ]);
    });

    Route::group(['prefix'=>'saidas', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'saidas',         'uses'=>'SaidasController@index'  ]);
        Route::get('create',       ['as'=>'saidas.create',  'uses'=>'SaidasController@create' ]);
        Route::get('{id}/destroy', ['as'=>'saidas.destroy', 'uses'=>'SaidasController@destroy']);
        Route::get('edit',         ['as'=>'saidas.edit',    'uses'=>'SaidasController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'saidas.update',  'uses'=>'SaidasController@update' ]);
        Route::post('store',       ['as'=>'saidas.store',   'uses'=>'SaidasController@store'  ]);
    });

    Route::group(['prefix'=>'fornecedores', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'fornecedores',         'uses'=>'FornecedoresController@index'  ]);
        Route::get('create',       ['as'=>'fornecedores.create',  'uses'=>'FornecedoresController@create' ]);
        Route::get('{id}/destroy', ['as'=>'fornecedores.destroy', 'uses'=>'FornecedoresController@destroy']);
        Route::get('edit',         ['as'=>'fornecedores.edit',    'uses'=>'FornecedoresController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'fornecedores.update',  'uses'=>'FornecedoresController@update' ]);
        Route::post('store',       ['as'=>'fornecedores.store',   'uses'=>'FornecedoresController@store'  ]);
    });

    Route::group(['prefix'=>'tipo_entradas', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'tipo_entradas',         'uses'=>'TipoEntradasController@index'  ]);
        Route::get('create',       ['as'=>'tipo_entradas.create',  'uses'=>'TipoEntradasController@create' ]);
        Route::get('{id}/destroy', ['as'=>'tipo_entradas.destroy', 'uses'=>'TipoEntradasController@destroy']);
        Route::get('edit',         ['as'=>'tipo_entradas.edit',    'uses'=>'TipoEntradasController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'tipo_entradas.update',  'uses'=>'TipoEntradasController@update' ]);
        Route::post('store',       ['as'=>'tipo_entradas.store',   'uses'=>'TipoEntradasController@store'  ]);
    });

    Route::group(['prefix'=>'tipo_saidas', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'tipo_saidas',         'uses'=>'TipoSaidasController@index'  ]);
        Route::get('create',       ['as'=>'tipo_saidas.create',  'uses'=>'TipoSaidasController@create' ]);
        Route::get('{id}/destroy', ['as'=>'tipo_saidas.destroy', 'uses'=>'TipoSaidasController@destroy']);
        Route::get('edit',         ['as'=>'tipo_saidas.edit',    'uses'=>'TipoSaidasController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'tipo_saidas.update',  'uses'=>'TipoSaidasController@update' ]);
        Route::post('store',       ['as'=>'tipo_saidas.store',   'uses'=>'TipoSaidasController@store'  ]);
    });

    Route::group(['prefix'=>'tipo_clientes', 'where'=>['id'=>'[0-9]+']], function() {
        Route::any('',             ['as'=>'tipo_clientes',         'uses'=>'TipoClientesController@index'  ]);
        Route::get('create',       ['as'=>'tipo_clientes.create',  'uses'=>'TipoClientesController@create' ]);
        Route::get('{id}/destroy', ['as'=>'tipo_clientes.destroy', 'uses'=>'TipoClientesController@destroy']);
        Route::get('edit',         ['as'=>'tipo_clientes.edit',    'uses'=>'TipoClientesController@edit'   ]);
        Route::put('{id}/update',  ['as'=>'tipo_clientes.update',  'uses'=>'TipoClientesController@update' ]);
        Route::post('store',       ['as'=>'tipo_clientes.store',   'uses'=>'TipoClientesController@store'  ]);
    });
});
