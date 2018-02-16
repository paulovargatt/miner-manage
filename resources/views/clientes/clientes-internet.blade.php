@extends('adminlte::page')

@section('title', 'Todos os Clientes')

@section('content')

       <div class="col-md-1 text-center col-sm-2 col-xs-4" >
           <button type="button" class="btn btn-success btn-sm" id="filtroTodos">Parcela em dia</button>
       </div>

       <div class="col-md-2 text-center col-sm-2 col-xs-4">
           <button type="button" class="btn btn-danger btn-sm" id="filtroDev">Filtrar Devedores</button>
       </div>
       <div class="col-md-1 col-sm-2 col-xs-4">
           <button type="button" class="btn btn-primary btn-sm" id="estatisticas">Estatisticas</button>
       </div>

       <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="input-group">
                   <input type="text" name="search" required="required" id="search" class="form-control" placeholder="Pesquisar Cliente">
                   <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i style="    color: #222d32;" class="fa fa-search"></i>
                </button>
              </span>
               </div>
       </div>


<div class="clear-fix"></div>
<br>
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
                    $('#clientesNet').append(data).hide().slideDown();
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
                    $('#clientesNet').append(data).hide().slideDown();
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

        $(document).on('click','#search-btn', function () {
            var input = $('#search').val();

            if(input == ''){
                return;
            }

            $.ajax({
                type: 'get',
                url: '/clientes/internet/search',
                data: {
                    'search': input
                },
                success: function (data) {
                    $('#clientesNet').empty();
                    $('#clientesNet').append(data).hide().fadeIn(500);
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

        $(document).on('click','#estatisticas', function () {
            $.ajax({
                type: 'get',
                url: '/clientes/internet/estatisticas',
                success: function (data) {
                    $('#clientesNet').empty();
                    $('#clientesNet').append(data).hide().slideDown(500);
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

        $('#search').keypress(function(e) {
            if(e.which == 13) {
                $('#search-btn').click()
            }
        });
    </script>
@endsection


