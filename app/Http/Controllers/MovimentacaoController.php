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


        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->descricao = 'Foram adicionados <span class="text-green">'.$incSaldo.
            '</span> Saldo Anterior <span class="text-red">'.$saldoAnterior
            .' </span> Novo Saldo:  <span class="text-blue">'. $total . '</span>';
        $movimentacao->save();

        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }
}
