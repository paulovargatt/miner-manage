@extends('adminlte::page')

@section('title')
    {{$cliente->name}}
@stop

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
@stop

@section('content_header')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box saldo">
                <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo</span>
                    <span class="info-box-number balance_ls {{$cliente->balance < 0 ? 'text-red' : ''}}">{{$cliente->balance}} </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
                <div class="info-box-content ">
                    <span class="info-box-text">Poder de Mineração</span>
                    <span class="info-box-number minerpower"><input class="input_power_miner"
                                                                    value="{{$cliente->power_miner}}"> {{$cliente->coin_name == 'Ethereum' ? 'MH/s' : 'ZH/s'}}</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Plano</span>
                    <span class="info-box-number">
                    <select id="plan" style="border: 0px;">
                        @foreach($coin as $coins)
                            <option id="{{$coins->id}}" {{$coins->id == $cliente->coin_id ? 'selected' : ''}}>{{$coins->name}}</option>
                        @endforeach
                    </select>
                </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Contrato</span>
                    <span class="info-box-number">{{$cliente->date_plan->diffForHumans()}}</span>
                    <input id="datepicker" value="{{$cliente->date_plan->format('d/m/Y')}} "/>

                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="clear-fix"></div>
    <div class="container" style="width: 100%">
        <div class="nav-tabs-custom" style="width: 100%">
            <ul class="nav nav-tabs">
                <li><h4 style="margin: 10px 71px;"><b>{{$cliente->name}}</b></h4></li>
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Movimentações</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Editar Dados</a></li>
                <li style="width: 220px;margin: -8px;">
                    <div class="input-group margin">
                        <input type="text" id="plus-saldo" class="form-control" value="0.000000">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat"
                                    id="btn-plus-saldo">Aumentar Saldo </button>
                        </span>
                    </div>
                </li>

                <li style="width: 185px;margin: -8px 15px">
                    <div class="input-group margin">
                        <input type="text" id="pagar" class="form-control" value="0.000000">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat" id="btn-pagar">Pagar </button>
                        </span>
                    </div>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <b>Movimentações</b>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Usuário</th>
                            <th>Descrição</th>
                            <th>Data</th>
                        </tr>

                            @foreach($cargaMovimentation as $movimentacao)
                                <tr>
                                <td>{{$movimentacao->name}}</td>
                                <td class="td_desc">{!! $movimentacao->descricao !!}</td>
                                <td>{{$movimentacao->created_at->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <b>Editar</b>
                </div>
            </div>
        </div>
    </div>


@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <script>

        var poweMiner = "{{$cliente->power_miner}}";
        var datePlan = "{{$cliente->date_plan}}";
        var clienteId = "{{$cliente->id}}";
        this.saldoCli = "{{$cliente->balance}}";

        $('#plus-saldo').mask('0.000000');
        $('#pagar').mask('0.000000');
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });


        $('.content-header').on('change', function () {
            var plan = $('#plan option:selected').attr('id');
            var power_miner = $('.input_power_miner').val();
            var datepicker = $('#datepicker').val();

            $.ajax({
                url: 'update-cliente/{{$cliente->id}}',
                method: "POST",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "plan": plan,
                    "power_miner": power_miner,
                    "date": datepicker
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                success: function (data) {
                    toastr.success('' + data.msg + ' :)');
                    $('#loader').fadeOut();
                    setTimeout(function () {
                        window.location.reload()
                    }, 1000);
                },
                error: function () {
                    toastr.warning('erro ao salvar');
                    $('#loader').fadeOut();
                }
            });
        });


        $(document).on('click', '#btn-plus-saldo', function () {
            var saldo = $('#plus-saldo').val();
            $.ajax({
                url: 'update-saldo-cliente/{{$cliente->id}}',
                method: "POST",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "plus_saldo": saldo
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                complete: function () {
                    $('#loader').fadeOut();
                    $('.balance_ls').load(' .balance_ls');

                    movimentos(saldoCli,saldo, clienteId);

                    var valor = parseInt($('.balance_ls').text());
                    tot = valor + pagar;
                    if (tot < 0) {
                        $('.balance_ls').css('color', 'red')
                    } else {
                        $('.balance_ls').css('color', '#333333')
                        $('.balance_ls').removeClass('text-red')
                    }
                }
            });
        });

        $(document).on('click', '#btn-pagar', function () {
            var pagar = $('#pagar').val();
            $.ajax({
                url: 'update-saldo-cliente/{{$cliente->id}}',
                method: "POST",
                dataType: "JSON",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pagar": pagar
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                complete: function () {
                    $('#loader').fadeOut();
                    $('.balance_ls').load(' .balance_ls');
                    var valor = parseInt($('.balance_ls').text());
                    tot = valor - pagar;
                    if (tot < 0) {
                        $('.balance_ls').css('color', 'red')
                    } else {
                        $('.balance_ls').css('color', '#333333')
                    }
                }
            });
        });


        function MinerCalc() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/json-miner',
                success: function (data) {
                    var netHash = data.nethash;
                    var hashPower = (poweMiner * 1e6) / netHash;
                    var blockTime = data.block_time;
                    var blockReward = data.block_reward24;
                    var blocksPerMin = 60 / blockTime;
                    var coinPermine = blocksPerMin * blockReward;
                    var ganho = hashPower * coinPermine;
                    var ganhoDia = ganho * 60 * 24;
                    var resulGanho = ganhoDia.toFixed(6);
                    console.log(resulGanho);
                    $('#plus-saldo').val(resulGanho);
                }
            });

        };MinerCalc();

        function movimentos(saldoAntigo, saldoAtual,cliente) {
            var calc = parseFloat(saldoCli) + parseFloat(saldoAtual);
            console.log(calc);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'movimenta/'+cliente,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "saldoAnt": saldoCli,
                    "newSaldo": saldoAtual,
                    "total": calc.toFixed(6)
                },
                beforeSend: function () {
                    $('#loader').fadeIn();
                },
                success: function (data) {
                    toastr.success('' + data.msg + ' :)');
                    $('#loader').fadeOut();
                }
            });
        }



    </script>
@endsection