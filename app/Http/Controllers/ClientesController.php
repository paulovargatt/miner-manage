<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Moedas;
use App\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class ClientesController extends Controller
{
    public function index(Request $request, $id)
    {
        $cliente = Clientes::
        where('clientes.id', $id)
            ->join('moedas', 'moedas.id', '=', 'clientes.coin_id')
            ->select('clientes.*', 'moedas.name as coin_name')
            ->first();
        $coin = Moedas::all();

        $cargaMovimentation = Movimentacao::where('cliente_id', $id)
                            ->join('users','users.id','movimentacaos.user_id')
                            ->select('movimentacaos.*','users.name')
                            ->orderBy('created_at','DESC')
                            ->get();
        return view('clientes.index', compact('cliente', 'coin','cargaMovimentation'));
    }


    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        $cliente->coin_id = $request->get('plan');
        $cliente->power_miner = $request->get('power_miner');
        $cliente->date_plan = Carbon::createFromFormat('d/m/Y', $request->get('date'));
        $cliente->update();
        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }

    public function updateSaldo(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        if ($request->plus_saldo) {
            $cliente->balance += $request->get('plus_saldo');
            $cliente->update();
        } else {
            $cliente->balance -= $request->get('pagar');
            $cliente->update();
        }


    }


    public function getJsonMiner()
    {
        $url = urldecode("https://whattomine.com/coins/151.json");
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }

}
