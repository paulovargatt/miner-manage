<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clientes = Clientes::join('moedas','moedas.id','=','clientes.coin_id')
            ->select('clientes.*','moedas.name as coin_name')
            ->paginate(15);

        return view('home', compact('clientes'));
    }
}
