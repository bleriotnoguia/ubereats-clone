<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Home').' | '.config('app.name') }}</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>
        <div class="position-ref full-height header">
            <div class="overlay flex-center">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn btn-primary btn-bnweb" href="{{ url('/dashboard') }}">Tableau de bord</a>
                    @else
                        <a class="btn btn-primary btn-bnweb" href="{{ route('login') }}">Connexion</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif --}}
                    @endauth
                </div>
                @endif
    
                <div class="content">
                    <div class="title m-b-md">
                        Uber Eats clone
                    </div>
    
                    <div class="sub-title">
                        <h3 class="m-b-md">Vendre mes plats et gerer mes restaurants partout.</h3>
                        @auth
                            <a class="btn btn-primary btn-bnweb" href="{{ url('/dashboard') }}">Tableau de bord</a>
                        @else
                            <a class="btn btn-primary btn-bnweb" href="{{ route('login') }}">Connexion</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif --}}
                    @endauth
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
