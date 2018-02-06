<?php

namespace App\Http\Controllers;

use App\Clientes;
use App\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;
use Gate;


class MovimentacaoController extends DataTables
{
    public function movimentaCliente(Request $request,$id){
        $saldoAnterior =  $request->get('saldoAnt');
        $incSaldo = $request->get('newSaldo');
        $total = $request->get('total');
        $power = $request->get('poweMiner');

        $cliCoin = Clientes::find($id);
        $cliCoin = $cliCoin->coin_id;

        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->minerado = $request->get('newSaldo');
        if($cliCoin != 3) {
             $movimentacao->descricao = 'Foi minerado <span class="text-green">' . $incSaldo . '</span>
             Poder de Mineração: <span class="text-navy">' . $power . '</span>
             Saldo Anterior <span class="text-red">' . $saldoAnterior . ' </span>
             Novo Saldo:  <span class="text-blue">' . $total . '</span>';
        }else{
            $movimentacao->descricao = '<b>Pagamento Realizado pelo Cliente</b> <span class="text-green">'.'R$: '. $incSaldo . '</span>
             Plano: <span class="text-navy">' . $power . '</span>
             Saldo Anterior <span class="text-red">' . $saldoAnterior . ' </span>
             Novo Saldo:  <span class="text-blue">' . $total . '</span>';
        }
        $movimentacao->save();

        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }

    public function movimentaPagamentoCliente(Request $request, $id){
        $saldoAnterior =  $request->get('saldoAnt');
        $pagamento = $request->get('pagamento');
        $total = $request->get('total');

        $cliCoin = Clientes::find($id);
        $cliCoin = $cliCoin->coin_id;

        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $id;
        $movimentacao->user_id = Auth::user()->id;
        $movimentacao->pago = $request->get('pagamento');

         if($cliCoin != 3) {
             $movimentacao->descricao =   '<b>Pagamento Realizado</b> <span style="font-size: 1.2em" class="text-green">' . $pagamento . '</span>
             Saldo Anterior <span class="text-blue">' . $saldoAnterior . ' </span>
             Novo Saldo:  <span class="text-red">' . $total . '</span>';
         }else{
             $movimentacao->descricao =   '<i>Taxa Diária, foi descontado:</i>  <span style="font-size: 1.2em" class="text-red">'.'R$: ' . $pagamento . '</span>
             Saldo Anterior <span class="text-blue">' . $saldoAnterior . ' </span>
             Novo Saldo:  <span class="text-blue">' . $total . '</span>';
         }
        $movimentacao->save();

        $ret = array('status' => 'success',
            'msg' => 'Atualizado');
        return response()->json($ret);
    }

    public function jsonMovimentacoes($id){
        $cargaMovimentation = Movimentacao::where('movimentacaos.cliente_id', $id)
            ->join('users','users.id','movimentacaos.user_id')
            ->select('movimentacaos.*','users.name')
            ->orderBy('created_at','DESC')
            ->get();

        if (Gate::allows('user', Auth::user()->type)) {
            if (Auth::user()->cliente_id != $id) {
                return back();
            }
        }

        return DataTables::of($cargaMovimentation)
            ->addColumn('descricao', function ($cargaMovimentation) {
                return
                    $cargaMovimentation->descricao;
            })
            ->addColumn('created_at', function ($cargaMovimentation) {
                return
                    $cargaMovimentation->created_at->format('d/m/Y H:i');
            })
            ->rawColumns(['descricao','created_at'])
            ->make(true);
    }

}
