<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Moedas;
use App\Movimentacao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use function MongoDB\BSON\toJSON;
Use Yajra\DataTables\DataTables;
use Gate;

class ClientesController extends Controller
{
    public function index(Request $request, $id)
    {
        $cliente = Clientes::where('clientes.id', $id)
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

        if (Gate::allows('user', Auth::user()->type)) {
            if (Auth::user()->cliente_id != $id) {
                return back();
            }
        }

        // dd($totalMinerado);
        $users = User::where('cliente_id', '=', $id)->get();
        //dd($users);

        return view('clientes.index', compact('cliente',
            'coin', 'totalPago', 'totalMinerado','users'));
    }


    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        $cliente->coin_id = $request->get('plan');
        $cliente->power_miner = $request->get('power_miner');
        $cliente->date_plan = Carbon::createFromFormat('d/m/Y', $request->get('date'));
        $cliente->date_pagamento = Carbon::createFromFormat('d/m/Y', $request->get('date_pagamento'));
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
        return redirect('/cliente/' . $cliente->id);
    }

    public function UsuarioForCliente(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->cliente_id = $request->get('cliente_id');
        $user->save();

        $ret = array('status' => 'success',
            'msg' => 'Usuário criado!');
        return response()->json($ret);
    }

    public function updateUserCliente(Request $request, $user_id)
    {
        $user = User::find($user_id);


        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password') != '')
           $user->password  = bcrypt($request->get('password'));
        $user->save();

        $ret = array('status' => 'success',
            'msg' => 'Usuário Atualizado Com Sucesso!');
        return response()->json($ret);
    }

    public function delete(Request $request) {
        $IdCli = $request->get('clientId');
        $clientes = Clientes::find($IdCli);
        $clientes->delete();
        $ret = array(
            'status' => 'success',
            'msg' => 'Cliente Deletado com sucesso!'
        );
        return response()->json($ret);

    }


    public function listEth (){
        $clientes = Clientes::where('coin_id',1)->get();
        $url = urldecode("https://whattomine.com/coins/151.json");
        $json = json_decode(file_get_contents($url), true);
        foreach ($clientes as $calcCliente) {
            $netHash = $json['nethash'];
            $dificult = $json['difficulty'];
            $dificult24 = $json['difficulty24'];
            $netHashCalc = ($netHash / $dificult) * $dificult24;
            $hashPower = ($calcCliente->power_miner * 1e6) / $netHashCalc;
            $blockTime = $json['block_time'];
            $blockReward = $json['block_reward24'];
            $blocksPerMin = 60 / $blockTime;
            $coinPermine = $blocksPerMin * $blockReward;
            $ganho = $hashPower * $coinPermine;
            $ganhoDia = $ganho * 60 * 24;

            $clienteId = $calcCliente->id;
            $powerCli = $calcCliente->power_miner;
            $saldoAnterior = $calcCliente->balance;
            $newSaldo = number_format($ganhoDia,6,'.',',');

            Movimentacao::mineraCliente($clienteId,$newSaldo,$saldoAnterior,$powerCli);
            Clientes::updateBalance($clienteId,$newSaldo);
            echo 'Foi minerado por: '. $calcCliente->name. ' Power: '.$powerCli . ' '. $newSaldo . ' Data:' . Date('d/m/Y') .'<br>';
        }

    }

}
