<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grs Miners</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/landing.css" rel="stylesheet">
    <script src="https://use.edgefonts.net/black-ops-one.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
</head>
<body>
<div id="particles-js"></div>
<div class="loginbtn">
    @auth
        <a href="{{ route('home') }}" class="action-button shadow animate blue logar">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="action-button shadow animate blue logar">Entrar</a>
    @endauth
</div>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    @endif

    <div class="text-center">
        <h1 class="logo-font">GRS Miners</h1>
        <div class="box text-center">
            <h3 class="opens">Quer minerar Ethereum? </h3>
            <p>Confira nossos planos abaixo e veja como faturar alto</p>
        </div>
    </div>
</div>

<div class="container bg-light box-table">
    <h4 class="opens text-center" style="padding: 10px;"><img class="img-responsive"
                                                              src="https://i.imgur.com/VYxxsMQ.png"></h4>
    <div class="row">
        <div class="col-md-4 text-center" style="margin-top: 33px">
            <h4 class="bold text-success">Plano de: 10MH/S</h4>
            <p class="opens bold" style="margin-top: 5px;font-size: 0.9em;"> Invista R$: 990,00</p>
            <p class="opens bold" style="margin-top: -16px;font-size: 0.9em;"> Ganhe: <span
                        id="twoYear_ganho_br_span"></span></p>
            <button class="btn btn-success" style="z-index: 9; position: relative">Contratar</button>
            <br>
            <small>Em até 10x</small>
            <br>
            <small>Contrato com validade de 2 Anos *</small>
        </div>
        <div class="col-md-8">
            <table class="table" style="width: 100%; margin: 0 auto;">
                <tbody>
                <tr>
                    <th>Previsão</th>
                    <th>Minerado</th>
                    <th>Retorno do Investimento:</th>
                </tr>
                <tr>
                    <td>Dia</td>
                    <td><span id="ganho_Dia"></span></td>
                    <td><span class="text-green" id="ganho_Dia_br"></span></td>
                </tr>
                <tr>
                    <td>Mês</td>
                    <td><span id="mes_ganho"></span></td>
                    <td><span class="text-green" id="mes_ganho_br"></span></td>
                </tr>
                <tr>
                    <td>Ano</td>
                    <td><span id="ano_ganho"></span></td>
                    <td><span class="text-green" id="ano_ganho_br"></span></td>
                </tr>
                <tr>
                    <td>2 Anos</td>
                    <td><span id="twoYear_ganho"></span></td>
                    <td><span class="text-green destGanho" id="twoYear_ganho_br"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <br>

        <div class="col-md-4 text-center" style="margin-top: 39px" >
            <h4 class="bold text-success">Plano de: 05 MH/S</h4>
                <p class="opens bold" style="margin-top: 5px"> Invista apenas R$:590,00</p>
                <button class="btn btn-success" style="z-index: 9; position: relative">Contratar</button>
                <br>
                <small>Em até 10x</small>
                <br>
                <small>Contrato com validade de 2 Anos *</small>
        </div>

        <div class="col-md-8">
            <table class="table">
                <tbody>
                <tr>
                    <th>Previsão</th>
                    <th>Minerado</th>
                    <th>Retorno do Investimento:</th>
                </tr>
                <tr>
                    <td>Dia</td>
                    <td><span id="ganho_DiaCinco"></span></td>
                    <td><span class="text-green" id="ganho_Dia_brCinco"></span></td>
                </tr>
                <tr>
                    <td>Mês</td>
                    <td><span id="mes_ganhoCinco"></span></td>
                    <td><span class="text-green" id="mes_ganho_brCinco"></span></td>
                </tr>
                <tr>
                    <td>Ano</td>
                    <td><span id="ano_ganhoCinco"></span></td>
                    <td><span class="text-green" id="ano_ganho_brCinco"></span></td>
                </tr>
                <tr>
                    <td>2 Anos</td>
                    <td><span id="twoYear_ganhoCinco"></span></td>
                    <td><span class="text-green destGanho" id="twoYear_ganho_brCinco"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/lp.js"></script>
<script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', '/particles.json', function () {
        console.log('callback - particles.js config loaded');
    });
    getEth(10);
    getEthCinco(5);
</script>


</body>
</html>
