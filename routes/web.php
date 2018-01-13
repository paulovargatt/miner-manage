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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('can:admin');
    /*Clientes*/
    Route::get('/cliente/todos', 'ClientesController@allClients')->middleware('can:admin');
    Route::get('/cliente/cadastro', 'ClientesController@cadastrarCliente')->middleware('can:admin');;
    Route::post('/cliente/post-form-new-client', 'ClientesController@postCadastrarCliente')->middleware('can:admin');
    Route::get('/cliente/{id}', 'ClientesController@index')->name('cliente');
    Route::post('/cliente/update-desc/{id}', 'ClientesController@updateDesc')->middleware('can:admin');
    Route::post('/cliente/update-cliente/{id}', 'ClientesController@update')->middleware('can:admin');
    Route::post('/cliente/update-saldo-cliente/{id}', 'ClientesController@updateSaldo')->middleware('can:admin');
    /*Movimentacao*/
    Route::post('/cliente/movimenta/{id}', 'MovimentacaoController@movimentaCliente')->middleware('can:admin');;
    Route::post('/cliente/movimenta-pagamento/{id}', 'MovimentacaoController@movimentaPagamentoCliente')->middleware('can:admin');;
    Route::get('/cliente/get-json-movimentacoes/{id}', 'MovimentacaoController@jsonMovimentacoes');
    /*Miner GET Jsons What to Miner*/

    Route::get('json-miner', 'ClientesController@getJsonMiner')->middleware('can:admin');;
    Route::get('json-miner-zcash', 'ClientesController@getJsonMinerZcash')->middleware('can:admin');;

});