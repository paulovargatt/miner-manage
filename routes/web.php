<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['cors']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    /*Clientes*/
    Route::get('/cliente/todos', 'ClientesController@allClients');
    Route::get('/cliente/cadastro', 'ClientesController@cadastrarCliente');
    Route::post('/cliente/post-form-new-client', 'ClientesController@postCadastrarCliente');

    Route::get('/cliente/{id}', 'ClientesController@index')->name('cliente');
    Route::post('/cliente/update-desc/{id}', 'ClientesController@updateDesc');
    Route::post('/cliente/update-cliente/{id}', 'ClientesController@update');
    Route::post('/cliente/update-saldo-cliente/{id}', 'ClientesController@updateSaldo');

    /*Movimentacao*/
    Route::post('/cliente/movimenta/{id}', 'MovimentacaoController@movimentaCliente');
    Route::post('/cliente/movimenta-pagamento/{id}', 'MovimentacaoController@movimentaPagamentoCliente');
    Route::get('/cliente/get-json-movimentacoes/{id}', 'MovimentacaoController@jsonMovimentacoes');

    /*Miner GET Jsons What to Miner*/
    Route::get('json-miner', 'ClientesController@getJsonMiner');
    Route::get('json-miner-zcash', 'ClientesController@getJsonMinerZcash');

});