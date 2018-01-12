<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Moedas;
use App\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
Use Yajra\DataTables\DataTables;

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

        $movimentacoes = Movimentacao::where('cliente_id', $id)
            ->select('pago', 'minerado')
            ->get();
        $totalPago = null;
        $totalMinerado = null;
        foreach ($movimentacoes as $mov) {
            $totalPago += $mov->pago;
            $totalMinerado += $mov->minerado;
        }
        // dd($totalMinerado);
        return view('clientes.index', compact('cliente', 'coin', 'totalPago', 'totalMinerado'));
    }


    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        $cliente->coin_id = $request->get('plan');
        $cliente->power_miner = $request->get('power_miner');
        $cliente->date_plan = Carbon::createFromFormat('d/m/Y', $request->get('date'));
        $cliente->name = $request->get('name');
        $cliente->update();
        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }

    public function updateDesc(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        $cliente->desc = $request->get('notas');
        $cliente->update();
        $ret = array('status' => 'success',
            'msg' => 'Bloco de Notas atualizado');
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

    public function getJsonMinerZcash()
    {
        $url = urldecode("https://whattomine.com/coins/166.json");
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }

    public function allClients()
    {
        $clientes = Clientes::join('moedas', 'moedas.id', '=', 'clientes.coin_id')
            ->select('clientes.*', 'moedas.name as coin_name')
            ->paginate(16);
        return view('clientes.all-client', compact('clientes'));
    }

    public function cadastrarCliente()
    {
        $coin = Moedas::all();
        return view('clientes.cadastro', compact('coin'));
    }

    public function postCadastrarCliente(Request $request)
    {
        $cliente = new Clientes();
        $cliente->name = $request->get('name');
        $cliente->coin_id = $request->get('select');
        $cliente->power_miner = $request->get('power');
        $cliente->desc = $request->get('desc');
        $cliente->save();

        return redirect('/cliente/'.$cliente->id);

        dd($cu);
    }

}
