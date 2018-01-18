<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://use.edgefonts.net/black-ops-one.js"></script>
        <!-- Styles -->
        <style>
            html, body {
                height: 100vh;
                margin: 0;
                background: linear-gradient(175deg, #0b362b, #222d32, #1a2226);
                background-size: 600% 600%;
                -webkit-animation: background 5s ease infinite;
                -moz-animation: background 5s ease infinite;
                animation: background 5s ease infinite;
            }

            @-webkit-keyframes background {
                0%{background-position:0% 41%}
                50%{background-position:100% 60%}
                100%{background-position:0% 41%}
            }
            @-moz-keyframes background {
                0%{background-position:0% 41%}
                50%{background-position:100% 60%}
                100%{background-position:0% 41%}
            }
            @keyframes background {
                0%{background-position:0% 41%}
                50%{background-position:100% 60%}
                100%{background-position:0% 41%}
            }

            .full-height {
                height: 20vh;
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
                color: #FFDB17;
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
                font-family: 'Pacifico', cursive;
                font-size: 19px;
                color: #FFF;
                text-decoration: none;
            }

            .blue
            {
                background-color: #3498DB;
                border-bottom: 5px solid #2980B9;
                text-shadow: 0px -2px #2980B9;
            }

            .action-button:active
            {
                transform: translate(0px,5px);
                -webkit-transform: translate(0px,5px);
                border-bottom: 3px solid #2980B9;
                padding: 7px 20px;

            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            @endif
            <div class="text-center">
                <h1 class="logo-font">GRS Miner</h1>
                <div class="box text-center">
                    @auth
                        <a href="{{ route('home') }}" class="action-button shadow animate blue logar">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="action-button shadow animate blue logar">Entrar</a>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>
