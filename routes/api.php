<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => 'Api'], function () {
    #/clientes (GET, POST)
    #/clientes/:id (GET, PUT, DELETE)
    Route::group(['prefix' => 'clientes'], function () {
        Route::get('/', 'ClienteController@index');
        Route::post('/', 'ClienteController@store');
        Route::get('/{id}', 'ClienteController@show');
        Route::delete('/{id}', 'ClienteController@destroy');
        Route::put('/{id}', 'ClienteController@update');
    });
    #/pedidos (GET, POST)
    #/pedidos/:id (GET, PUT, DELETE)
    Route::group(['prefix' => 'pedidos'], function () {
        Route::get('/', 'PedidoController@index');
        Route::post('/', 'PedidoController@store');
        Route::get('/{id}', 'PedidoController@show');
        Route::delete('/{id}', 'PedidoController@destroy');
        Route::put('/{id}', 'PedidoController@update');
    });
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
