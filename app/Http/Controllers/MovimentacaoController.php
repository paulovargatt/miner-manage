<?php

namespace App\Http\Controllers;

use App\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class MovimentacaoController extends Controller
{
    public function movimentaCliente(Request $request,$id){
        $saldoAnterior =  $request->get('saldoAnt');
        $incSaldo = $request->get('newSaldo');
        $total = $request->get('total');
        $power = $request->get('poweMiner');

        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->descricao =
        'Foi minerado <span class="text-green">'.$incSaldo.'</span>
         Poder de Mineração: <span class="text-navy">'.$power.'</span>
         Saldo Anterior <span class="text-red">'.$saldoAnterior.' </span>
         Novo Saldo:  <span class="text-blue">'. $total . '</span>';

        $movimentacao->save();

        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }

    public function movimentaPagamentoCliente(Request $request, $id){
        $saldoAnterior =  $request->get('saldoAnt');
        $pagamento = $request->get('pagamento');
        $total = $request->get('total');

        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->descricao =
        '<b>Pagamento Realizado</b> <span style="font-size: 1.2em" class="text-green">'.$pagamento.'</span>
         Saldo Anterior <span class="text-blue">'.$saldoAnterior.' </span>
         Novo Saldo:  <span class="text-red">'. $total . '</span>';
        $movimentacao->save();

        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }
}
