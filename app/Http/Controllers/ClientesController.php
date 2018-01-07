<?php

namespace App\Http\Controllers;

use App\Clientes;
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

        return view('clientes.index', compact('cliente'));
    }
}
