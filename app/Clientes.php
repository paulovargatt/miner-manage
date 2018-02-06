<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{

    use SoftDeletes;

    protected $fillable = ['name','coin_id','power_miner','balance','desc','date_plan','date_pagamento'];

    protected $dates = [
        'date_plan',
        'created_at',
        'updated_at',
        'deleted_at',
        'date_pagamento'
    ];


    public static function updateBalance($clienteId, $newBalance){
       $cli = Clientes::find($clienteId);
           if($cli->coin_id != 3){
                 $cli->balance += $newBalance;
           }else{
                $cli->balance -= $newBalance;
           }
       $cli->save();
    }

   public function Moeda(){
       return $this->hasOne(Moedas::class);
   }
}
