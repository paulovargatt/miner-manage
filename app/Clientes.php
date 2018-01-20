<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

    protected $dates = [
        'date_plan',
        'created_at',
        'updated_at',
        'deleted_at',
        'date_pagamento'
    ];

   public function Moeda(){
       return $this->hasOne(Moedas::class);
   }
}
