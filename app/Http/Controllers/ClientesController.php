<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Moedas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClientesController extends Controller
{
    public function index(Request $request, $id){
        $cliente = Clientes::
             where('clientes.id',$id)
            ->join('moedas','moedas.id','=','clientes.coin_id')
            ->select('clientes.*','moedas.name as coin_name')
            ->first();

        $coin = Moedas::all();

        return view('clientes.index', compact('cliente','coin'));
    }


    public function update(Request $request, $id){
        $cliente = Clientes::find($id);
        $cliente->coin_id = $request->get('plan');
        $cliente->update();
    }

    public function updateSaldo(Request $request, $id){
        $cliente = Clientes::find($id);
        if($request->plus_saldo) {
            $cliente->balance += $request->get('plus_saldo');
            $cliente->update();
        }
        else{
            $cliente->balance  -= $request->get('pagar');
            $cliente->update();
        }



    }


    public function getJsonMiner(){
        $url = urldecode("https://whattomine.com/coins/151.json");
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }

}
