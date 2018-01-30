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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/landing.css" rel="stylesheet">
    <script src="https://use.edgefonts.net/black-ops-one.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
</head>
<body>
<div id="preloader"></div>
<div id="particles-js"></div>
<div class="loginbtn">
    @auth
        <a href="{{ route('home') }}" class="action-button shadow animate blue logar">Dashboard</a>
    @else
        <a href="{{ route('login') }}" class="action-button shadow animate blue logar"><i class="fa fa-sign-in"
                                                                                          aria-hidden="true"></i>
            Entrar</a>
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
        <div class="col-md-4 text-center card-price">
            <div class="box">
                <div class="ribbon"><span>GOLD</span></div>
            </div>
            <h4 class="bold text-grs">Plano de: 100 MH/S</h4>
            <p class="opens bold" style="margin-top: 5px;font-size: 0.9em;"> Invista R$: 8.800</p>
            <p class="opens bold" style="margin-top: -16px;font-size: 0.9em;"> Ganhe:
                <span id="twoYear_ganho_br_span"></span></p>
            <a class="btn btn-success" mp-mode="dftl"
               href="https://www.mercadopago.com/mlb/checkout/start?pref_id=35797019-a4843026-ffa2-4ace-8c1e-57a910eca489"
               name="MP-payButton" class='blue-ar-l-rn-none' style="z-index: 9; position: relative"><i
                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                Contratar</a>
            <br>
            <small>Em até 10x</small>
            <br>
            <small><i class="fa fa-info" aria-hidden="true"></i> Válido por 2 Anos após contratação</small>

            <a class="pull-right question" data-toggle="modal" data-target="#modalDuvida">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-md-7">
            <table class="table" style="width: 100%; margin: 0 auto;">
                <tbody>
                <tr>
                    <th>Previsão</th>
                    <th>Minerado</th>
                    <th>Retorno:</th>
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

        <div class="col-md-4 text-center card-price">
            <div class="box">
                <div class="ribbon platinum"><span>Silver </span></div>
            </div>
            <h4 class="bold text-grs">Plano de: 10 MH/S</h4>
            <p class="opens bold" style="margin-top: 5px"> Invista R$:990,00</p>
            <p class="opens bold" style="margin-top: -16px;font-size: 0.9em;"> Ganhe:
                <span id="twoYear_ganho_br_spanDez"></span></p>
            <a mp-mode="dftl"
               href="https://www.mercadopago.com/mlb/checkout/start?pref_id=35797019-363bef74-08d6-406d-8a73-e8d76a04516a"
               name="MP-payButton" class="btn btn-success" style="z-index: 9; position: relative"><i
                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                Contratar</a>
            <br>
            <small>Em até 10x</small>
            <br>
            <small><i class="fa fa-info" aria-hidden="true"></i> Válido por 2 Anos após contratação</small>
            <a class="pull-right question" data-toggle="modal" data-target="#modalDuvida">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
            </a>

        </div>

        <div class="col-md-7">
            <table class="table">
                <tbody>
                <tr>
                    <th>Previsão</th>
                    <th>Minerado</th>
                    <th>Retorno:</th>
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


    <div class="row">
        <div class="col-md-4 text-center card-price">
            <div class="box">
                <div class="ribbon platinum"><span>Basic </span></div>
            </div>
            <h4 class="bold text-grs">Plano de: 1 MH/S</h4>
            <p class="opens bold" style="margin-top: 5px"> Invista apenas R$:109,90</p>
            <p class="opens bold" style="margin-top: -16px;font-size: 0.9em;"> Ganhe:
                <span id="twoYear_ganho_br_spanUm"></span></p>
            <a mp-mode="dftl"
               href="https://www.mercadopago.com/mlb/checkout/start?pref_id=35797019-dc8eda65-f9b8-41d5-901f-10b0aa7ad093"
               name="MP-payButton" class="btn btn-success" style="z-index: 9; position: relative"><i
                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                Contratar</a>
            <br>
            <small>Em até 10x</small>
            <br>
            <small><i class="fa fa-info" aria-hidden="true"></i> Válido por 2 Anos após contratação</small>

            <a class="pull-right question" data-toggle="modal" data-target="#modalDuvida">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
            </a>
        </div>

        <div class="col-md-7">
            <table class="table">
                <tbody>
                <tr>
                    <th>Previsão</th>
                    <th>Minerado</th>
                    <th>Retorno:</th>
                </tr>
                <tr>
                    <td>Dia</td>
                    <td><span id="ganho_DiaUm"></span></td>
                    <td><span class="text-green" id="ganho_Dia_brUm"></span></td>
                </tr>
                <tr>
                    <td>Mês</td>
                    <td><span id="mes_ganhoUm"></span></td>
                    <td><span class="text-green" id="mes_ganho_brUm"></span></td>
                </tr>
                <tr>
                    <td>Ano</td>
                    <td><span id="ano_ganhoUm"></span></td>
                    <td><span class="text-green" id="ano_ganho_brUm"></span></td>
                </tr>
                <tr>
                    <td>2 Anos</td>
                    <td><span id="twoYear_ganhoUm"></span></td>
                    <td><span class="text-green destGanho" id="twoYear_ganho_brUm"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="text-center">Porque a GRS Miners ?</h2>
    <div class="text-center">
        <p class="lead" style="width: 70%;margin: 0 auto;"> Tenha a experiência de minerar online, não se preocupe com
        configurações, máquinas barulhentas em sua casa que precisam de espaço e refrigeração intensa.
        </p>

        <br>
        <strong>Interface fácil e intuitiva</strong>
        <div class="row">
        <div class="col-9 mx-auto d-block">
            <img class="img-responsive img-fluid text-center" src="https://i.imgur.com/r7QH7iq.jpg">
        </div>
            <p class="lead" style="width: 70%;margin: 10px auto;margin-bottom: 50px">
                Acompanhe diariamente sua conta, monitore todas as entradas e pagamentos,
                confira ainda uma previsão de rendimento atualizada a toda hora.
            </p>
            <br>
        </div>
        </div>

</div>


<!--Modal Duvidas -->
<div class="modal" tabindex="-1" role="dialog" id="modalDuvida">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dúvidas ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong>Porque devo contratar? </strong>
                <p>Você irá entrar para o mundo das criptomoedas sem precisar se preocupar com
                    hardware, configurações e manutenções geradas pela atividade de minerar.</p>
                <strong>Acompanhe seu progresso com uma interface simples</strong>
                <p>Após realizar a contratação você irá acessar sua conta online através
                    de um login e senha que será gerado em até 24 horas após aprovado seu pagamento, nesse local você
                    irá poder acompanhar o status da mineração atualizado todos os dias.</p>

                <strong>Solicite seu pagamento ao atingir 0,05 ETH;
                </strong>
                <p>
                    Diferente das outras empresas disponiveis no mercado que levam as vezes
                    mais de 1 ano para realizar um pagamento ao cliente, a GRS Miners
                    se compromete em transferir o pagamento ao cliente quando atingir esse valor
                </p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/lp.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', '/particles.json', function () {
            console.log('callback - particles.js config loaded');
        });


        /*(function () {
            function $MPC_load() {
                window.$MPC_loaded !== true && (function () {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                    window.$MPC_loaded = true;
                })();
            }

            window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
        })();*/

        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5a6eacfad7591465c7072a4a/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>

</body>
</html>
