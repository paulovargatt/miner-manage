<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Moedas;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request, $id){
        $cliente = Clientes::
             where('clientes.id',$id)
            ->join('moedas','moedas.id','=','clientes.coin_id')
            ->select('clientes.*','moedas.name as coin_name')
            ->first();
         //   dd($cliente);

        $coin = Moedas::all();

        return view('clientes.index', compact('cliente','coin'));
    }


    public function update(Request $request, $id){
        $cliente = Clientes::find($id);
        $cliente->coin_id = $request->get('plan');
        $cliente->update();
    }
}
