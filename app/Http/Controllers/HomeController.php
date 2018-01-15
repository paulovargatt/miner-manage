<?php

namespace App\Http\Controllers;

use App\Movimentacao;
use App\User;
use Illuminate\Http\Request;
use App\Clientes;
use Illuminate\Support\Facades\Auth;
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

        return view('home', compact('clientes','totalMinerado','totalPago'));
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

}
