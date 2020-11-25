<?php
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'clientes', 'where'=>['id'=>'[0-9]+']], function() {
    Route::get('',             ['as'=>'clientes',         'uses'=>'ClientesController@index'  ]);
    Route::get('create',       ['as'=>'clientes.create',  'uses'=>'ClientesController@create' ]);
    Route::get('{id}/destroy', ['as'=>'clientes.destroy', 'uses'=>'ClientesController@destroy']);
    Route::get('{id}/edit',    ['as'=>'clientes.edit',    'uses'=>'ClientesController@edit'   ]);
    Route::put('{id}/update',  ['as'=>'clientes.update',  'uses'=>'ClientesController@update' ]);
    Route::post('store',       ['as'=>'clientes.store',   'uses'=>'ClientesController@store'  ]);
});

Route::group(['prefix'=>'produtos', 'where'=>['id'=>'[0-9]+']], function() {
    Route::get('',             ['as'=>'produtos',         'uses'=>'ProdutosController@index'  ]);
    Route::get('create',       ['as'=>'produtos.create',  'uses'=>'ProdutosController@create' ]);
    Route::get('{id}/destroy', ['as'=>'produtos.destroy', 'uses'=>'ProdutosController@destroy']);
    Route::get('{id}/edit',    ['as'=>'produtos.edit',    'uses'=>'ProdutosController@edit'   ]);
    Route::put('{id}/update',  ['as'=>'produtos.update',  'uses'=>'ProdutosController@update' ]);
    Route::post('store',       ['as'=>'produtos.store',   'uses'=>'ProdutosController@store'  ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
