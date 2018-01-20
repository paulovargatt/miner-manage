<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{

    use SoftDeletes;

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
