@extends('adminlte::page')

@section('title')
    {{$cliente->name}}
@stop

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
                <li><h4><b><input class="input_name" value="{{$cliente->name}}" ></b></h4></li>
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Movimentações</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Bloco de Notas</a></li>
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
            </div>
        </div>
    </div>


@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/plugins/colorbutton/plugin.js"></script>

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


        $('.content-header, .input_name').on('change', function () {
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
                    "date": datepicker,
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

        $(document).on('click','.btn-bloco', function () {
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


        $(document).on('click', '#btn-plus-saldo', function () {
            var valida = $('#plus-saldo').val().replace('.','').length;
            if (valida < 7){
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

            var valida = $('#pagar').val().replace('.','').length;
            if (valida < 7 || $('#pagar').val().replace('.','') == 0000000){
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


        function MinerCalc() {
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
                    var resulGanho = ganhoDia.toFixed(6);
                    console.log(resulGanho);
                    $('#plus-saldo').val(resulGanho);
                }
            });
        }

        MinerCalc();

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

        var table = $('#movimentacoes').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'get-json-movimentacoes/' + clienteId,
            columns: [
                {data: 'descricao', name: 'descricao', orderable: false},
                {data: 'created_at', name: 'created_at', orderable: true},

            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
            }
        });


        $(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.config.height = 300;
          //  CKEDITOR.config.extraPlugins = 'colorbutton';
        });
    </script>
@endsection