<?php

namespace App\Http\Controllers;

use App\Movimentacao;
use App\User;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Clientes;
use Illuminate\Support\Facades\Auth;
use Gate;
use Validator;

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
        ->where('coin_id', '!=', 3)
        ->select('clientes.*','moedas.name as coin_name')
        ->paginate(16);

        $movimentacoes = Movimentacao::select('pago', 'minerado')
         ->get();

        $totalPago = null;
        $totalMinerado = null;
        foreach ($movimentacoes as $mov) {
            $totalPago += $mov->pago;
            $totalMinerado += $mov->minerado;
        }

        $datesPagamento = Clientes::select('id','date_pagamento','name')
            ->limit('6')
            ->orderBy('date_pagamento','ASC')
            ->get();


        if (Gate::allows('user', Auth::user()->type)) {
            if (Auth::user()->cliente_id != 10) {
                return redirect('cliente/'.Auth::user()->cliente_id);
            }
        }

        return view('home', compact('clientes','totalMinerado','totalPago','datesPagamento'));
    }

    public function novaSenha(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('nova-senha',compact('user'));
    }

    public function updateSenha(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);

        $valida = Validator::make($request->all(), [
           'name' => 'required',
           'email' => 'required',
        ]);

        if ($valida->passes()) {
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if ($request->get('password') != '') {
                $user->password = bcrypt($request->get('password'));
            }
            $user->save();
            $request->session()->flash('alert-success', 'Usuário Atualizado com sucesso!');
        }else {
            $request->session()->flash('alert-warning', $valida->errors() );
        }

        return back();
    }

    public function getTopMiners(){
        $clientes = Clientes::select('name as label', 'power_miner as value')
                    ->where('coin_id', '=', 1)
                    ->get();
       $tot = $clientes->toJson();
        return $tot;
    }
    public function getTopMinerZcash(){
        $clientes = Clientes::select('name as label', 'power_miner as value')
                    ->where('coin_id', '=', 2)
                    ->get();
       $tot = $clientes->toJson();
        return $tot;
    }

    public function getClientesInternet(){

        $clientes = Clientes::join('moedas','moedas.id','=','clientes.coin_id')
            ->where('coin_id', '=', 3)
            ->select('clientes.*','moedas.name as coin_name')
            ->paginate(16);

        return view('clientes.clientes-internet',compact('clientes'));
    }


}
