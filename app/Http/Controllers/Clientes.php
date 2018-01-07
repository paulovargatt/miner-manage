<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Clientes extends Controller
{
    public function GetClientes(){

        $clientes = Clientes::paginate(1);
        return view('home', compact('clientes'));

    }
}
