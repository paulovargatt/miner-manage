<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Grs Miners</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script src="https://use.edgefonts.net/black-ops-one.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                height: 100vh;
                margin: 0;
                background: linear-gradient(-45deg, #000000, #011e20, #212c31, #000000);
                background-size: 400% 400%;
                -webkit-animation: Gradient 15s ease infinite;
                -moz-animation: Gradient 15s ease infinite;
                animation: Gradient 15s ease infinite;
            }

            @-webkit-keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            @-moz-keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            @keyframes Gradient {
                0% {
                    background-position: 0% 50%
                }
                50% {
                    background-position: 100% 50%
                }
                100% {
                    background-position: 0% 50%
                }
            }

            .full-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .logo-font{
                font-family: black-ops-one, sans-serif;
                color: #f0f4f7;
                font-size: 3.5em;
            }

            .text-center{
                text-align: center;
            }

            .animate
            {
                transition: all 0.1s;
                -webkit-transition: all 0.1s;
            }

            .action-button
            {
                position: relative;
                padding: 8px 21px;
                margin: 0px 10px 10px 0px;
                border-radius: 5px;
                font-family: 'Open Sans', sans-serif;
                font-size: 19px;
                color: #FFF;
                text-decoration: none;
            }

            .blue
            {
                background-color: #f0f4f7;
                border-bottom: 5px solid #b9b9b9;
                font-weight: 700;
                color: #000000;
                font-size: 1.2em;
            }

            .action-button:active
            {
                transform: translate(0px,5px);
                -webkit-transform: translate(0px,5px);
                border-bottom: 3px solid #272727;
                padding: 7px 20px;
            }
            .particles-js-canvas-el{position: absolute}
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    </head>
    <body>
    <div id="particles-js"></div>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            @endif
            <div class="text-center">
                <h1 class="logo-font">GRS Miners</h1>
                <div class="box text-center">
                    @auth
                        <a href="{{ route('home') }}" class="action-button shadow animate blue logar">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="action-button shadow animate blue logar">Entrar</a>
                    @endauth
                </div>
            </div>
        </div>
        <script>
            /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
            particlesJS.load('particles-js', '/particles.json', function() {
                console.log('callback - particles.js config loaded');
            });
        </script>
    </body>
</html>
