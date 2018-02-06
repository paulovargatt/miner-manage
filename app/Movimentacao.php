<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{

    protected $fillable = ['cliente_id','user_id','pago','minerado','descricao'];

    public static function mineraCliente($clienteId, $newsaldo, $saldoAnterior, $power ){
        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $clienteId;

        $coinCli = Clientes::find($clienteId);
        $coinCli = $coinCli->coin_id;

        $movimentacao->user_id = 1;
        $movimentacao->minerado = $newsaldo;
        if($coinCli != 3) {
            $total = $saldoAnterior + $newsaldo;
        }else{
            $total = $saldoAnterior - $newsaldo;
        }

        if($coinCli != 3){
            $movimentacao->descricao =
            'Foi minerado <span class="text-green">'.$newsaldo.'</span>
             Poder de Mineração: <span class="text-navy">'.$power.'</span>
             Saldo Anterior <span class="text-red">'.$saldoAnterior.' </span>
             Novo Saldo:  <span class="text-blue">'. $total . '</span>';
        }else{
            $movimentacao->descricao =
             '<i>Taxa Diária - foi descontado:</i> <span class="text-red">'.$newsaldo.'</span>
             Saldo Anterior <span class="text-blue">'.$saldoAnterior.' </span>
             Novo Saldo:  <span class="text-blue">'. $total . '</span>';
        }
        $movimentacao->save();
    }

}
