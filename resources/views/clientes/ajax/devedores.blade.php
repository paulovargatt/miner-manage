    @forelse($clientes as $cliente)
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <a href="/cliente/{{$cliente->id}}">
                    <div class="widget-user-header" style="background-color: #0073b7;">
                        <h4 class="text-center">{{$cliente->name}}
                            <div class="pull-right"><i style="position: absolute;right: 7px;" class="fa fa-globe"></i>
                            </div>
                        </h4>
                    </div>
                </a>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>Contrato: <span class="pull-right badge bg-blue"> {{ $cliente->coin_name}}</span></li>
                        <li>Plano: <span class="pull-right badge bg-aqua">{{$cliente->power_miner}} R$ Mensal</span></li>
                        <li>Saldo<span class="pull-right badge {{$cliente->balance < 0 ? 'bg-red' : 'bg-green'}} ">{{$cliente->balance}} R$</span></li>
                        <li>Data:<span
                        class="pull-right badge bg-red">{{$cliente->date_plan->diffForHumans() .' - '. $cliente->date_plan->format('d/m/Y')}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @empty
        <h3 style="margin-left: 15px"> Sem clientes no momento...</h3>
    @endforelse

    <div class="clear-fix"></div>
