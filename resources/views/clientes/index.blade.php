@extends('adminlte::page')

@section('title', ' Cliente')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/skins/moono/editor.css">
@stop

@section('content_header')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box saldo">
                <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo</span>
                    <span class="info-box-number balance_ls @if($cliente->balance){{$cliente->balance < 0 ? 'text-red' : ''}}">{{$cliente->balance}}@endif </span>
                </div>
                <span title="Total Pago" class="totPago">{{$totalPago}}</span>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
                <div class="info-box-content ">
                    <span class="info-box-text">Poder de Mineração</span>
                    <span class="info-box-number minerpower">
                        <input class="input_power_miner" @can('user', Auth::user()->type) disabled @endcan
                        value="{{$cliente->power_miner}}"> {{$cliente->coin_name == 'Ethereum' ? 'MH/s' : 'H/s'}}
                    </span>
                    <span title="Total Minerado" class="totMinerado">{{$totalMinerado}}</span>
                    <div class="cssload-tetrominos pull-right">
                        <div class="cssload-tetromino cssload-box1"></div>
                        <div class="cssload-tetromino cssload-box2"></div>
                        <div class="cssload-tetromino cssload-box3"></div>
                        <div class="cssload-tetromino cssload-box4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-navy"><i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Plano</span>
                    <span class="info-box-number">
                    <select id="plan" style="border: 0px;" @can('user', Auth::user()->type) disabled @endcan>
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
                    <span class="info-box-text">Venc. Contrato</span>
                    <span class="info-box-number">
                       </span>
                    <input id="datepicker" @can('user', Auth::user()->type) disabled
                           @endcan value="{{$cliente->date_plan != null ? $cliente->date_plan->format('d/m/Y') : '01/01/2020'}}"/>

                    <span class="info-box-text">Prox. Pagamento</span>
                    <span class="info-box-number">
                       </span>
                    <input id="datepagamento"
                    @can('user', Auth::user()->type) disabled
                    @endcan value="{{$cliente->date_pagamento != null ? $cliente->date_pagamento->format('d/m/Y') : '01/01/2020'}}"/>
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
                <li><h4><b><input @can('user', Auth::user()->type) disabled @endcan class="input_name"
                                  value="{{$cliente->name}}"></b></h4></li>
                @cannot('user', Auth::user()->type)
                <li style="width: 180px;margin: -8px;">
                    <div class="input-group margin">
                        <input type="text" id="plus-saldo" class="form-control" value="0.000000">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success btn-flat"
                                    id="btn-plus-saldo">Adicionar</button>
                        </span>
                    </div>
                </li>
                <li style="width: 160px;margin: -8px 5px">
                    <div class="input-group margin">
                        <input type="text" id="pagar" class="form-control" value="0.000000">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat" id="btn-pagar">Pagar </button>
                        </span>
                    </div>
                </li>
                @endcannot
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-rss" aria-hidden="true"></i> Movimentações</a></li>

                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">
                        <i class="fa fa-usd" aria-hidden="true"></i> Previsão de Rendimentos</a></li>

            @cannot('user', Auth::user()->type)
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">
                            <i class="fa fa-address-book" aria-hidden="true"></i> Notas</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Usuário</a></li>
            @endcannot
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <table id="movimentacoes" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Data</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <textarea name="editor1" class="notas textarea" id="bloco_notas" style="width: 100%; font-size: 14px; line-height: 18px;
                    border: 1px solid rgb(221, 221, 221); padding: 10px;">
                    {!! $cliente->desc !!}
                    </textarea>
                    <button class="btn btn-primary btn-bloco">Salvar</button>
                </div>

                <div class="tab-pane" id="tab_3">
                    <div class="clear-fix"></div>
                    <div class="row">
                        @if($users->isEmpty())
                            <h3 class="text-center">Cadastrar Usuário para cliente</h3>
                            <form method="post">
                                {{ csrf_field() }}
                                <div class="col-md-4">
                                    <input class="form-control input_name_user" type="text" value="{{$cliente->name}}">
                                    <br>
                                    <input class="form-control input_mail_user" type="text" value="" name="email"
                                           placeholder="E-mail">
                                    <br>
                                    <input class="form-control input_pass_user" type="password" value=""
                                           placeholder="Senha">
                                    <br>
                                    <button class="btn btn-success newcliente_user">Salvar</button>
                                </div>
                            </form>
                        @endif
                        <div class="container"><br>
                            <div class="clear-fix"></div>
                            @if(!$users->isEmpty())
                                <table class="table table-bordered table_users">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Senha</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($users as $user)
                                            <td><input class="td_name_user_up" required value="{{$user->name}}"></td>
                                            <td><input class="td_mail_user_up" required value="{{$user->email}}"></td>
                                            <td><input class="td_pass_user_up" required type="password" placeholder="Nova Senha"></td>
                                            <td>
                                                <button class="btn btn-xs btn-success update_user_cliente">Atualizar </button>
                                            </td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab_4">
                    <div class="clear-fix"></div>
                    <div class="row">
                        <div class="container" style="padding: 0px 25px;">
                            <h3 class="text-center">Previsão de rendimentos</h3>
                            <h4 class="text-center">Poder de mineração atual: <b>{{$cliente->power_miner}}</b></h4>
                            <table class="table table-bordered table_ganhos" style="width: 100%; margin: 0 auto;">
                                <tbody>
                                <tr>
                                    <th>Ganho</th>
                                    <th>Total</th>
                                    <th>$USD</th>
                                    <th>R$:</th>
                                </tr>
                                <tr>
                                    <td>Dia </td>
                                    <td><span id="ganho_Dia"></span></td>
                                    <td><span id="ganho_Dia_usd"></span></td>
                                    <td><span class="text-green" id="ganho_Dia_br"></span></td>
                                </tr>
                                <tr>
                                    <td>Semana </td>
                                    <td><span id="semana_ganho"></span></td>
                                    <td><span id="semana_ganho_usd"></span></td>
                                    <td><span class="text-green" id="semana_ganho_br"></span></td>
                                </tr>
                                <tr>
                                    <td>Mês </td>
                                    <td><span id="mes_ganho"></span></td>
                                    <td><span id="mes_ganho_usd"></span></td>
                                    <td><span class="text-green" id="mes_ganho_br"></span></td>
                                </tr>
                                <tr>
                                    <td>Ano </td>
                                    <td><span id="ano_ganho"></span></td>
                                    <td><span id="ano_ganho_usd"></span></td>
                                    <td><span class="text-green" id="ano_ganho_br"></span></td>
                                </tr>
                                <tr>
                                    <td>2 Anos </td>
                                    <td><span id="twoYear_ganho"></span></td>
                                    <td><span id="twoYear_ganho_usd"></span></td>
                                    <td><span class="text-green" id="twoYear_ganho_br"></span></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <p class="text-center">* As cotações acima são baseadas no valor <b>ATUAL</b> de venda da moeda.
                                <br>Os valores devem ser utilizados SOMENTE para se ter uma BASE.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @cannot('user', Auth::user()->type)<span class="pull-right btn btn-danger btn-xs" id="deleteCliente">Deletar Cliente</span>@endcannot
    </div>


@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="/js/script.js"></script>

    <script>
        this.MoedaMinerada = {{$cliente->coin_id}};
        this.type = "{{auth()->user()->type}}";
        var poweMiner = "{{$cliente->power_miner}}";

        @if(Auth()->user()->type == 10)

        var datePlan = "{{$cliente->date_plan}}";
        var clienteId = "{{$cliente->id}}";
        this.saldoCli = "{{$cliente->balance}}";

        if (this.type == 10) {
            $('#plus-saldo').mask('0.000000');
            $('#pagar').mask('0.000000');
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });

            $('#datepagamento').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });


            $('.content-header, .input_name').on('change', function () {
                var plan = $('#plan option:selected').attr('id');
                var power_miner = $('.input_power_miner').val();
                var datepicker = $('#datepicker').val();
                var datepagamento = $('#datepagamento').val();
                $.ajax({
                    url: 'update-cliente/{{$cliente->id}}',
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "plan": plan,
                        "power_miner": power_miner,
                        "date": datepicker,
                        "date_pagamento": datepagamento,
                        "name": $('.input_name').val()
                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                        Atualiza()
                    },
                    error: function () {
                        toastr.warning('erro ao salvar');
                        $('#loader').fadeOut();
                    }
                });
            });

            $(document).on('click', '.btn-bloco', function () {
                $.ajax({
                    url: 'update-desc/{{$cliente->id}}',
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "notas": CKEDITOR.instances.bloco_notas.getData()
                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                    },
                    error: function () {
                        toastr.warning('erro ao salvar');
                        $('#loader').fadeOut();
                    }
                });
            });

            $(document).on('click', '.newcliente_user', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'up-or-create-user/{{$cliente->id}}',
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": $('.input_name_user').val(),
                        "email": $('.input_mail_user').val(),
                        "password": $('.input_pass_user').val(),
                        "cliente_id": "{{$cliente->id}}"

                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                        Atualiza();
                    },
                    error: function () {
                        toastr.warning('erro ao salvar');
                        $('#loader').fadeOut();
                    }
                });
            });

            $(document).on('click', '.update_user_cliente', function () {
                $.ajax({
                    url: 'update-user-cliente/@if(!$users->isEmpty()){{$users[0]->id}}@endif',
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": $('.td_name_user_up').val(),
                        "email": $('.td_mail_user_up').val(),
                        "password": $('.td_pass_user_up').val()
                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                    },
                    error: function () {
                        toastr.warning('erro ao salvar');
                        $('#loader').fadeOut();
                    }
                });
            });


            $(document).on('click', '#btn-plus-saldo', function () {
                var valida = $('#plus-saldo').val().replace('.', '').length;
                if (valida < 7) {
                    toastr.warning('Digite um valor Válido, exemplo 0.000000');
                    return
                }

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
                        movimentos(saldo, clienteId);

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

                var valida = $('#pagar').val().replace('.', '').length;
                if (valida < 7 || $('#pagar').val().replace('.', '') == 0000000) {
                    toastr.warning('Digite um valor Válido, exemplo 0.000000');
                    return
                }

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
                        movimentoPagamento(saldoCli, pagar, clienteId);
                    }
                });
            });


            function movimentos(saldoAtual, cliente) {
                var calc = parseFloat($('.balance_ls').text()) + parseFloat(saldoAtual);
                console.log(calc);
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'movimenta/' + cliente,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "saldoAnt": parseFloat($('.balance_ls').text()),
                        "newSaldo": saldoAtual,
                        "total": calc.toFixed(6),
                        "poweMiner": poweMiner
                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                        table.ajax.reload();
                    }
                });
            }

            function movimentoPagamento(saldoAtual, pagamento, cliente) {
                var calc = parseFloat($('.balance_ls').text()) - parseFloat(pagamento);
                console.log(calc);
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'movimenta-pagamento/' + cliente,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "saldoAnt": parseFloat($('.balance_ls').text()),
                        "pagamento": pagamento,
                        "total": calc.toFixed(6)
                    },
                    beforeSend: function () {
                        $('#loader').fadeIn();
                    },
                    success: function (data) {
                        toastr.success('' + data.msg + ' :)');
                        $('#loader').fadeOut();
                        table.ajax.reload();
                    }
                });
            }

            function Atualiza() {
                setTimeout(function () {
                    window.location.reload()
                }, 1000);
            }

            $(function () {
                CKEDITOR.replace('editor1');
                CKEDITOR.config.height = 300;
                //  CKEDITOR.config.extraPlugins = 'colorbutton';
            });

            $(document).on('click', '#deleteCliente', function () {
                var alerta = confirm(" Você tem certeza ? ");

                if (alerta == true) {
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: 'delete',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "clientId": clienteId
                        },
                        beforeSend: function () {
                            $('#loader').fadeIn();
                        },
                        success: function () {
                            window.location="../home"
                        }
                    });
                }
            })


        }

                @endif

        var table = $('#movimentacoes').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'get-json-movimentacoes/' + "{{$cliente->id}}",
                columns: [
                    {data: 'descricao', name: 'descricao', orderable: false},
                    {data: 'created_at', name: 'created_at', orderable: true},

                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            });

                if (this.MoedaMinerada === 1) {
                    (function MinerCalc() {
                        $.ajax({
                            type: 'GET',
                            dataType: 'json',
                            url: '/json-miner',
                            success: function (data) {
                                var netHash = data.nethash;
                                var dificult = data.difficulty;
                                var dificult24 = data.difficulty24;
                                netHash = (netHash / dificult) * dificult24;
                                var hashPower = (poweMiner * 1e6) / netHash;
                                var blockTime = data.block_time;
                                var blockReward = data.block_reward24;
                                var blocksPerMin = 60 / blockTime;
                                var coinPermine = blocksPerMin * blockReward;
                                var ganho = hashPower * coinPermine;
                                var ganhoDia = ganho * 60 * 24;
                                resulGanho = ganhoDia.toFixed(6);
                                $('#plus-saldo').val(resulGanho);
                                $('#ganho_Dia').text(resulGanho);
                                var  semana = ganhoDia * 7;
                                $('#semana_ganho').text(semana.toFixed(6));
                                var  mesGanho = ganhoDia * 30;
                                $('#mes_ganho').text(mesGanho.toFixed(6));
                                var  anoGanho = ganhoDia * 365;
                                $('#ano_ganho').text(anoGanho.toFixed(6));
                                var  twoYear = ganhoDia * 730;
                                $('#twoYear_ganho').text(twoYear.toFixed(6));
                                getEthPrice();

                            }
                        });
                    })();
                } else {
                    (function MinerCalc() {
                        $.ajax({
                            type: 'GET',
                            dataType: 'json',
                            url: '/json-miner-zcash',
                            success: function (data) {
                                var netHash = data.nethash;
                                var dificult = data.difficulty;
                                var dificult24 = data.difficulty24;
                                netHash = (netHash / dificult) * dificult24;
                                var hashPower = (poweMiner * 1) / netHash;
                                var blockTime = data.block_time;
                                var blockReward = data.block_reward24;
                                var blocksPerMin = 60 / blockTime;
                                var coinPermine = blocksPerMin * blockReward;
                                var ganho = hashPower * coinPermine;
                                var ganhoDia = ganho * 60 * 24;

                                resulGanho = ganhoDia.toFixed(6);
                                $('#plus-saldo').val(resulGanho);
                                $('#ganho_Dia').text(resulGanho);
                                var  semana = ganhoDia * 7;
                                $('#semana_ganho').text(semana.toFixed(6));
                                var  mesGanho = ganhoDia * 30;
                                $('#mes_ganho').text(mesGanho.toFixed(6));
                                var  anoGanho = ganhoDia * 365;
                                $('#ano_ganho').text(anoGanho.toFixed(6));
                                var  twoYear = ganhoDia * 730;
                                $('#twoYear_ganho').text(twoYear.toFixed(6));
                                getZcashPrice();
                            }
                        });
                    })();
                }

    </script>
@endsection