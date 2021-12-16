<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dangrek&display=swap" rel="stylesheet">

        <link rel="stylesheet" href={{ asset("/css/normalize.css") }}>
        <link rel="stylesheet" href={{ asset("/css/style.css") }}  >
        
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.ico') }}">
        <title>Watch me !</title>
    </head>
    <body>
        <header>
            <nav>
                <div id="nav">
                    <a href="{{ route('listeSeries') }}">Series</a>

                    <form action=" {{ route('searchSerie')}} " id="search" method="GET">
                        <input type="text" name="txt" id="txtSearch">
                        <input type="submit" value="Rechercher" id="btnSearch">
                    </form>
                </div>
                <a id="aLogo" href="{{ route('welcome') }}"><img id="logo" src= {{ asset("img/logo.png") }}></a>
                <div id="settingsConnexionSign">
                @guest
                    <a href="{{ route('login') }}">Connexion</a>
                    <a href="{{ route('register') }}">Inscription</a>
                @else
                    <a href="{{ route('showUser', ['id' => Auth::user()->id]) }}">{{ Auth::user()->name }}</a>
                    <a href="{{ route('logout') }}">Deconnexion</a>
                @endguest
                </div>
            </nav>
        </header>
        <!---->

        <div id="main">
            @yield('content')
        </div>

    </body>
</html>
