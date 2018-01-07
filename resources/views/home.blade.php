@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
       <div class="row">
           <div class="col-lg-6 col-xs-6">
               <div class="small-box bg-yellow">
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

           <div class="col-lg-6 col-xs-6">
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
       </div>
@stop

@section('content')

@stop

@section('scripts')
<script>
        var API = 'https://api.coinmarketcap.com/v1/ticker/';
        var ApiUSD = 'http://api.promasters.net.br/cotacao/v1/valores?moedas=USD&alt=json';
        var btc =  'bitcoin';
        var eth =  'ethereum';

        GetDolar = function(){
            $.ajax({
                url: ApiUSD,
                method: "GET",
                dataType: "JSON",
                success: function (data)
                {
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
                    $('#loader'+coin).css('display','block');
                },
                complete: function () {
                    $('#loader'+coin).css('display','none');
                },
                success: function (data)
                {
                    var ValueCoin = data[0].price_usd;
                    $('#preco'+coin+'').append(ValueCoin);

                    setTimeout(function(){
                        var calcUSD = parseInt(ValueCoin) * parseInt(USD);
                        $('#rs-'+coin+'').append(calcUSD);
                    }, 1000);
                }
            });
        };

        GetMoeda(btc);
        GetMoeda(eth);



</script>
@endsection