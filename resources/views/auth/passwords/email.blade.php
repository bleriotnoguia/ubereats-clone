@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="adminlte/plugins/iCheck/square/blue.css">
    <style>
        .content-wrapper{
            background-image: url(../img/home/background.jpg);
            background-size: cover;
            color: white;
        }

        /* For login */
        .login-logo a, .register-logo a {
            color: #fff !important;
            text-shadow: 1px 1px 2px #808080 !important;
        }
    </style>
@endsection

@section('main')

<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Ubereats</b>Log</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h2>Recuperer le mot de passe</h2>
            <p class="login-box-msg">Vous recevrez un email contenant les information pour reinitialisez votre mot de passe</p>
            <input id="email" type="email" placeholder="Addresse e-mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" style="margin-top: 10px; margin-bottom: 10px;" required>
            <p>
                @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </p>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Envoyer un email de recuperation') }}
                </button>
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
@endsection
