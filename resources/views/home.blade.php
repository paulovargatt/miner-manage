@extends('adminlte::page')

@section('title', 'GRS Miner')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
        #topMiners, #topMinersZcash{
            margin-top: -65px;
            margin-bottom: -56px;
        }
        .fa-trophy{
            margin-top: -50px;
            top: -27px;
            font-size: 0.7em;
            position: relative;}

        .topMinersTitle{
            font-size: 1.8em;
            color: black;
            font-weight: bold;
            top: 9px;
            position: relative;
        }
        .totEthMiner, .totZcashMiner{
            font-size: 16px;
            font-weight: 600;
            color: #00a65a;
        }

        .date-pag{
            font-size: 1.3em!important;
        }

        .name-cli-pag{
            font-weight: bold;
            font-size: 1.2em!important;
        }
    </style>
@endsection

@section('content_header')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 id="precobitcoin">
                        <div id="loaderbitcoin" style="display: none; position: absolute;left: 40px;">
                            <div class="spinner">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                        <sup style="font-size: 20px">$</sup></h3>
                    <p>Bitcoin Hoje <span id="rs-bitcoin">R$: </span></p>
                </div>
                <div class="icon">
                    <i class="fa fa-btc"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3 id="precoethereum">
                        <div id="loaderethereum" style="display: none; position: absolute;left: 40px;">
                            <div class="spinner">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                        <sup style="font-size: 20px">$</sup></h3>
                    <p>Ethereum Hoje <span id="rs-ethereum">R$: </span></p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>
                        {{$totalPago}}
                        <sup style="font-size: 20px">ETH</sup></h3>
                    <p>Total Pago a Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>
                        {{$totalMinerado}}
                        <sup style="font-size: 20px">ETH</sup></h3>
                    <p>Total minerado por Clientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-connectdevelop"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Top Mineradores
                        <sup style="font-size: 20px"></sup></h3>
                    <div class="col-md-6">
                        <h5 class="text-center topMinersTitle">Ethereum</h5>
                        <span class="totEthMiner"></span>
                        <div id="topMiners"></div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-center topMinersTitle">ZCash</h5>
                        <span class="totZcashMiner"></span>
                        <div id="topMinersZcash"></div>
                    </div>

                </div>
                <div class="icon">
                    <i class="fa fa-trophy"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Próximos Pagamentos<sup style="font-size: 20px"></sup></h3>
                </div>
            </div>
            <table class="table table-condensed text-center">
                <tbody>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                </tr>
                @foreach($datesPagamento as $date)
                    <tr>
                        <td><a href="/cliente/{{$date->id}}" target="_blank"><span class="name-cli-pag">{{$date->name}}</span></a></td>
                        <td><span class="badge date-pag {{$date->date_pagamento < \Carbon\Carbon::now() ? 'bg-red' : 'bg-green ' }}">
                                {{$date->date_pagamento->format('d/m/Y')}}
                             -  {{$date->date_pagamento->diffForHumans()}}
                        </span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop

@section('content')
    @foreach($clientes as $cliente)
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <a href="cliente/{{$cliente->id}}">
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

@section('scripts')
    <script>
        var API = 'https://api.coinmarketcap.com/v1/ticker/';
        var ApiUSD = 'http://api.promasters.net.br/cotacao/v1/valores?moedas=USD&alt=json';
        var btc = 'bitcoin';
        var eth = 'ethereum';

        GetBTCBR = function () {
            $.ajax({
                url: 'https://api.hgbrasil.com/finance/quotations?format=json-cors&key=f439632e',
                method: "GET",
                dataType: "JSON",
                success: function (data) {
                    BTC_BR = data.results;
                }
            });
        };


        GetDolar = function () {
            $.ajax({
                url: ApiUSD,
                method: "GET",
                dataType: "JSON",
                success: function (data) {
                    USD = data.valores.USD.valor;
                }
            });
        };
        GetDolar();

        GetMoeda = function (coin) {
            $.ajax({
                url: API + coin + '/',
                method: "GET",
                dataType: "JSON",
                beforeSend: function () {
                    $('#loader' + coin).css('display', 'block');
                },
                complete: function () {
                    $('#loader' + coin).css('display', 'none');
                },
                success: function (data) {
                    var ValueCoin = data[0].price_usd;
                    $('#preco' + coin + '').append(ValueCoin);

                    setTimeout(function () {
                        var calcUSD = ValueCoin * USD;
                        $('#rs-' + coin + '').append(calcUSD.toFixed(2));
                    }, 3500);
                }
            });
        };
        GetMoeda(btc);
        GetMoeda(eth);
    </script>

    <script src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script>

        (function TopMinerEth() {
            $.ajax({
                url: '/get-top-miners',
                method: "GET",
                dataType: "JSON",
                success: function (data) {
                    Morris.Donut({
                        element: 'topMiners',
                        data: data,
                        colors: [
                            '#222D32'
                        ],
                        backgroundColor: '#fff',
                        labelColor: '#0073B7',
                    });
                    var tot = 0
                    for (var i = 0; i< data.length; i++){
                        tot += parseFloat(data[i].value);
                    }
                    $('.totEthMiner').append(tot + ' MH/s')
                }
            });
        })();

        (function TopMinerZcash() {
            $.ajax({
                url: '/get-top-miners-zcash',
                method: "GET",
                dataType: "JSON",
                success: function (data) {
                    Morris.Donut({
                        element: 'topMinersZcash',
                        data: data,
                        colors: [
                            '#222D32'
                        ]
                    });
                    var tot = 0
                    for (var i = 0; i< data.length; i++){
                        tot += parseFloat(data[i].value);
                    }
                    $('.totZcashMiner').append(tot + ' H/s')
                }
            });
        })();





    </script>
@endsection