<?php
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\SaidasController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\ClientessController;
use App\Http\Controllers\TipoEntradasController;
use App\Http\Controllers\TipoSaidasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

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

        // #Clientes
        // Route::get('/clientes', 'ClientesController@index')->name('clientes.index');
        // Route::get('/clientes/create', 'ClientesController@create')->name('clientes.create');
        // Route::get('/clientes/edit/{id}', 'ClientesController@edit')->name('clientes.edit');
        // Route::get('/clientes/{id}', 'ClientesController@destroy')->name('clientes.destroy');
        // Route::post('/clientes/store', 'ClientesController@store')->name('clientes.store');
        // Route::post('/clientes/update/{id}', 'ClientesController@update')->name('clientes.update');

        // #Produtos
        // Route::get('/produtos', 'ProdutosController@index')->name('produtos.index');
        // Route::get('/produtos/create', 'ProdutosController@create')->name('produtos.create');
        // Route::get('/produtos/edit/{id}', 'ProdutosController@edit')->name('produtos.edit');
        // Route::get('/produtos/{id}', 'ProdutosController@destroy')->name('produtos.destroy');
        // Route::post('/produtos/store', 'ProdutosController@store')->name('produtos.store');
        // Route::post('/produtos/update/{id}', 'ProdutosController@update')->name('produtos.update');

        // #Entradas
        // Route::get('/entradas', 'EntradasController@index')->name('entradas.index');
        // Route::get('/entradas/create', 'EntradasController@create')->name('entradas.create');
        // Route::get('/entradas/edit/{id}', 'EntradasController@edit')->name('entradas.edit');
        // Route::get('/entradas/{id}', 'EntradasController@destroy')->name('entradas.destroy');
        // Route::post('/entradas/store', 'EntradasController@store')->name('entradas.store');
        // Route::post('/entradas/update/{id}', 'EntradasController@update')->name('entradas.update');

        // #Saidas
        // Route::get('/saidas', 'SaidasController@index')->name('saidas.index');
        // Route::get('/saidas/create', 'SaidasController@create')->name('saidas.create');
        // Route::get('/saidas/edit/{id}', 'SaidasController@edit')->name('saidas.edit');
        // Route::get('/saidas/{id}', 'SaidasController@destroy')->name('saidas.destroy');
        // Route::post('/saidas/store', 'SaidasController@store')->name('saidas.store');
        // Route::post('/saidas/update/{id}', 'SaidasController@update')->name('saidas.update');

        // #Fornecedores
        // Route::get('/fornecedores', 'FornecedoresController@index')->name('fornecedores.index');
        // Route::get('/fornecedores/create', 'FornecedoresController@create')->name('fornecedores.create');
        // Route::get('/fornecedores/edit/{id}', 'FornecedoresController@edit')->name('fornecedores.edit');
        // Route::get('/fornecedores/{id}', 'FornecedoresController@destroy')->name('fornecedores.destroy');
        // Route::post('/fornecedores/store', 'FornecedoresController@store')->name('fornecedores.store');
        // Route::post('/fornecedores/update/{id}', 'FornecedoresController@update')->name('fornecedores.update');

        // #Tipos de Entrada
        // Route::get('/tipo_entradas', 'TipoEntradasController@index')->name('tipo_entradas.index');
        // Route::get('/tipo_entradas/create', 'TipoEntradasController@create')->name('tipo_entradas.create');
        // Route::get('/tipo_entradas/edit/{id}', 'TipoEntradasController@edit')->name('tipo_entradas.edit');
        // Route::get('/tipo_entradas/{id}', 'TipoEntradasController@destroy')->name('tipo_entradas.destroy');
        // Route::post('/tipo_entradas/store', 'TipoEntradasController@store')->name('tipo_entradas.store');
        // Route::post('/tipo_entradas/update/{id}', 'TipoEntradasController@update')->name('tipo_entradas.update');

        // #Tipos de Saida
        // Route::get('/tipo_saidas', 'TipoSaidasController@index')->name('tipo_saidas.index');
        // Route::get('/tipo_saidas/create', 'TipoSaidasController@create')->name('tipo_saidas.create');
        // Route::get('/tipo_saidas/edit/{id}', 'TipoSaidasController@edit')->name('tipo_saidas.edit');
        // Route::get('/tipo_saidas/{id}', 'TipoSaidasController@destroy')->name('tipo_saidas.destroy');
        // Route::post('/tipo_saidas/store', 'TipoSaidasController@store')->name('tipo_saidas.store');
        // Route::post('/tipo_saidas/update/{id}', 'TipoSaidasController@update')->name('tipo_saidas.update');

        // #Tipos de Cliente
        // Route::get('/tipo_clientes', 'TipoClientesController@index')->name('tipo_clientes.index');
        // Route::get('/tipo_clientes/create', 'TipoClientesController@create')->name('tipo_clientes.create');
        // Route::get('/tipo_clientes/edit/{id}', 'TipoClientesController@edit')->name('tipo_clientes.edit');
        // Route::get('/tipo_clientes/{id}', 'TipoClientesController@destroy')->name('tipo_clientes.destroy');
        // Route::post('/tipo_clientes/store', 'TipoClientesController@store')->name('tipo_clientes.store');
        // Route::post('/tipo_clientes/update/{id}', 'TipoClientesController@update')->name('tipo_clientes.update');
    });
