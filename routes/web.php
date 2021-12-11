<?php

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'usuarios', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'usuarios',         'uses' => 'UsuariosController@index']);
        Route::get('create',       ['as' => 'usuarios.create',  'uses' => 'UsuariosController@create']);
        Route::get('{id}/destroy', ['as' => 'usuarios.destroy', 'uses' => 'UsuariosController@destroy']);
        Route::get('edit/{id}',    ['as' => 'usuarios.edit',    'uses' => 'UsuariosController@edit']);
        Route::put('/update',      ['as' => 'usuarios.update',  'uses' => 'UsuariosController@update']);
        Route::post('store',       ['as' => 'usuarios.store',   'uses' => 'UsuariosController@store']);
    });

    Route::group(['prefix' => 'clientes', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'clientes',         'uses' => 'ClientesController@index']);
        Route::get('create',       ['as' => 'clientes.create',  'uses' => 'ClientesController@create']);
        Route::get('{id}/destroy', ['as' => 'clientes.destroy', 'uses' => 'ClientesController@destroy']);
        Route::get('edit',         ['as' => 'clientes.edit',    'uses' => 'ClientesController@edit']);
        Route::put('{id}/update',  ['as' => 'clientes.update',  'uses' => 'ClientesController@update']);
        Route::post('store',       ['as' => 'clientes.store',   'uses' => 'ClientesController@store']);
    });

    Route::group(['prefix' => 'categorias', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'categorias',         'uses' => 'CategoriasController@index']);
        Route::get('create',       ['as' => 'categorias.create',  'uses' => 'CategoriasController@create']);
        Route::get('{id}/destroy', ['as' => 'categorias.destroy', 'uses' => 'CategoriasController@destroy']);
        Route::get('edit/{id}',    ['as' => 'categorias.edit',    'uses' => 'CategoriasController@edit']);
        Route::put('/update',      ['as' => 'categorias.update',  'uses' => 'CategoriasController@update']);
        Route::post('store',       ['as' => 'categorias.store',   'uses' => 'CategoriasController@store']);
    });

    Route::group(['prefix' => 'produtos', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'produtos',         'uses' => 'ProdutosController@index']);
        Route::get('create',       ['as' => 'produtos.create',  'uses' => 'ProdutosController@create']);
        Route::get('{id}/destroy', ['as' => 'produtos.destroy', 'uses' => 'ProdutosController@destroy']);
        Route::get('edit/{id}',    ['as' => 'produtos.edit',    'uses' => 'ProdutosController@edit']);
        Route::put('/update',      ['as' => 'produtos.update',  'uses' => 'ProdutosController@update']);
        Route::post('store',       ['as' => 'produtos.store',   'uses' => 'ProdutosController@store']);
    });

    Route::group(['prefix' => 'entradas', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'entradas',         'uses' => 'EntradasController@index']);
        Route::get('create',       ['as' => 'entradas.create',  'uses' => 'EntradasController@create']);
        Route::get('{id}/destroy', ['as' => 'entradas.destroy', 'uses' => 'EntradasController@destroy']);
        Route::post('{id}/stock',  ['as' => 'entradas.stock',   'uses' => 'EntradasController@stock']);
        Route::get('edit',         ['as' => 'entradas.edit',    'uses' => 'EntradasController@edit']);
        Route::put('{id}/update',  ['as' => 'entradas.update',  'uses' => 'EntradasController@update']);
        Route::post('store',       ['as' => 'entradas.store',   'uses' => 'EntradasController@store']);
        Route::post('generate',    ['as' => 'entradas.generate', 'uses' => 'EntradasController@generate']);
    });

    Route::group(['prefix' => 'saidas', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',                  ['as' => 'saidas',         'uses' => 'SaidasController@index']);
        Route::get('create',            ['as' => 'saidas.create',  'uses' => 'SaidasController@create']);
        Route::get('{id}/destroy',      ['as' => 'saidas.destroy', 'uses' => 'SaidasController@destroy']);
        Route::get('edit',              ['as' => 'saidas.edit',    'uses' => 'SaidasController@edit']);
        Route::put('{id}/update',       ['as' => 'saidas.update',  'uses' => 'SaidasController@update']);
        Route::post('store',            ['as' => 'saidas.store',   'uses' => 'SaidasController@store']);
        Route::get('getprods/{valor}',  ['as' => 'saidas.getprods',   'uses' => 'SaidasController@getprods']);
    });

    Route::group(['prefix' => 'fornecedores', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'fornecedores',         'uses' => 'FornecedoresController@index']);
        Route::get('create',       ['as' => 'fornecedores.create',  'uses' => 'FornecedoresController@create']);
        Route::get('{id}/destroy', ['as' => 'fornecedores.destroy', 'uses' => 'FornecedoresController@destroy']);
        Route::get('edit',         ['as' => 'fornecedores.edit',    'uses' => 'FornecedoresController@edit']);
        Route::put('{id}/update',  ['as' => 'fornecedores.update',  'uses' => 'FornecedoresController@update']);
        Route::post('store',       ['as' => 'fornecedores.store',   'uses' => 'FornecedoresController@store']);
    });

    Route::group(['prefix' => 'pedidos', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'pedidos',         'uses' => 'PedidosController@index']);
        Route::get('create',       ['as' => 'pedidos.create',  'uses' => 'PedidosController@create']);
        Route::get('{id}/destroy', ['as' => 'pedidos.destroy', 'uses' => 'PedidosController@destroy']);
        Route::get('edit',         ['as' => 'pedidos.edit',    'uses' => 'PedidosController@edit']);
        Route::put('{id}/update',  ['as' => 'pedidos.update',  'uses' => 'PedidosController@update']);
        Route::post('store',       ['as' => 'pedidos.store',   'uses' => 'PedidosController@store']);
        Route::get('getPedidos/{id}',  ['as' => 'pedidos.getPedidos',  'uses' => 'PedidosController@getPedidos']);
    });

    Route::group(['prefix' => 'tipo_entradas', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'tipo_entradas',         'uses' => 'TipoEntradasController@index']);
        Route::get('create',       ['as' => 'tipo_entradas.create',  'uses' => 'TipoEntradasController@create']);
        Route::get('{id}/destroy', ['as' => 'tipo_entradas.destroy', 'uses' => 'TipoEntradasController@destroy']);
        Route::get('edit/{id}',    ['as' => 'tipo_entradas.edit',    'uses' => 'TipoEntradasController@edit']);
        Route::put('/update',      ['as' => 'tipo_entradas.update',  'uses' => 'TipoEntradasController@update']);
        Route::post('store',       ['as' => 'tipo_entradas.store',   'uses' => 'TipoEntradasController@store']);
    });

    Route::group(['prefix' => 'tipo_saidas', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'tipo_saidas',         'uses' => 'TipoSaidasController@index']);
        Route::get('create',       ['as' => 'tipo_saidas.create',  'uses' => 'TipoSaidasController@create']);
        Route::get('{id}/destroy', ['as' => 'tipo_saidas.destroy', 'uses' => 'TipoSaidasController@destroy']);
        Route::get('edit/{id}',    ['as' => 'tipo_saidas.edit',    'uses' => 'TipoSaidasController@edit']);
        Route::put('/update',      ['as' => 'tipo_saidas.update',  'uses' => 'TipoSaidasController@update']);
        Route::post('store',       ['as' => 'tipo_saidas.store',   'uses' => 'TipoSaidasController@store']);
    });

    Route::group(['prefix' => 'tipo_clientes', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',             ['as' => 'tipo_clientes',         'uses' => 'TipoClientesController@index']);
        Route::get('create',       ['as' => 'tipo_clientes.create',  'uses' => 'TipoClientesController@create']);
        Route::get('{id}/destroy', ['as' => 'tipo_clientes.destroy', 'uses' => 'TipoClientesController@destroy']);
        Route::get('edit/{id}',    ['as' => 'tipo_clientes.edit',    'uses' => 'TipoClientesController@edit']);
        Route::put('/update',      ['as' => 'tipo_clientes.update',  'uses' => 'TipoClientesController@update']);
        Route::post('store',       ['as' => 'tipo_clientes.store',   'uses' => 'TipoClientesController@store']);
    });

    Route::group(['prefix' => 'estoque', 'where' => ['id' => '[0-9]+']], function () {
        Route::any('',      ['as' => 'estoque',        'uses' => 'EstoqueController@index']);
        Route::get('store', ['as' => 'estoque.store',  'uses' => 'EstoqueController@store']);
        Route::post('filter', ['as' => 'estoque.filter',  'uses' => 'EstoqueController@filter']);
    });

    #Exportar excel
    Route::post('{type}/export', ['as' => 'export', 'uses' => 'ExportContorller@export']);

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/graficoSaida', 'DashboardController@graficoSaida')->name('graficoSaida');
    Route::get('/graficoEntrada', 'DashboardController@graficoEntrada')->name('graficoEntrada');

    Route::get('/ajuda',    'AjudaController@index')->name('ajuda');
});
