@extends('adminlte::page')

@section('title', 'Todos os Clientes')

@section('content')
    {{--<h5 class="box-title" style="margin-left: 17px;font-size: 1.3em;"><i class="fa fa-users"></i> Clientes:</h5>--}}
    @foreach($clientes as $cliente)
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <a href="/cliente/{{$cliente->id}}">
                    <div class="widget-user-header">
                        <h4 class="text-center">{{$cliente->name}}</h4>
                    </div>
                </a>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>Moeda Principal<span class="pull-right badge bg-blue">{{$cliente->coin_name}}</span></li>
                        <li>Poder de mineração<span class="pull-right badge bg-aqua">{{$cliente->power_miner}}
                                M/Hs</span></li>
                        <li>Saldo<span class="pull-right badge bg-green">{{$cliente->balance}} ETH</span></li>
                        <li>Data:<span
                                    class="pull-right badge bg-red">{{$cliente->date_plan->diffForHumans() .' - '. $cliente->date_plan->format('d/m/Y')}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach

    <div class="clear-fix"></div>
    {{ $clientes->links() }}
@stop
