<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{

    protected $fillable = ['cliente_id','user_id','pago','minerado','descricao'];

    public static function mineraCliente($clienteId, $newsaldo, $saldoAnterior, $power ){
        $movimentacao = new Movimentacao();
        $movimentacao->cliente_id = $clienteId;
        $movimentacao->user_id = 1;
        $movimentacao->minerado = $newsaldo;
        $total = $saldoAnterior + $newsaldo;
        $movimentacao->descricao =
        'Foi minerado <span class="text-green">'.$newsaldo.'</span>
         Poder de Mineração: <span class="text-navy">'.$power.'</span>
         Saldo Anterior <span class="text-red">'.$saldoAnterior.' </span>
         Novo Saldo:  <span class="text-blue">'. $total . '</span>';
        $movimentacao->save();
    }

}
