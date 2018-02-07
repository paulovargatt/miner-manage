@extends('adminlte::page')

@section('title', 'Todos os Clientes')

@section('content')
    <h3 class="text-center" style="margin-top: -7px; margin-bottom: 10px"> Clientes Internet</h3>

    <button type="button" style="position: relative;top: -12px;left: 15px;"
            class="btn btn-success btn-sm" id="filtroTodos">Todos</button>

    <button type="button" style="position: relative;top: -12px;left: 15px;" class="btn btn-danger btn-sm" id="filtroDev">Filtrar Devedores</button>

    <div id="clientesNet">

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
            <h3>Sem clientes no momento...</h3>
        @endforelse

    </div>



    <div class="clear-fix"></div>
    {{ $clientes->links() }}
@stop

@section('scripts')
    <script>
        $(document).on('click','#filtroDev', function () {
            $.ajax({
                type: 'GET',
                url: '/clientes/internet/devedores',
                success: function (data) {
                    $('#clientesNet').empty();
                    $('#clientesNet').append(data);
                    $('#loader').fadeOut();
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                error: function () {
                    alert('erro');
                    $('#loader').fadeOut();
                }
            });
        });

        $(document).on('click','#filtroTodos', function () {
            $.ajax({
                type: 'GET',
                url: '/clientes/internet/todos',
                success: function (data) {
                    $('#clientesNet').empty();
                    $('#clientesNet').append(data);
                    $('#loader').fadeOut();
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                error: function () {
                    alert('erro');
                    $('#loader').fadeOut();
                }
            });
        });
    </script>
@endsection


