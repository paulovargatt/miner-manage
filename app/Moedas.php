<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moedas extends Model
{
    public function Clientes() {
        return $this->belongsTo('App\Clientes');
    }
}
