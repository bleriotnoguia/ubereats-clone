@extends('layouts.app')

@section('main')
    <div class="jumbotron text-center">
        <h2>{{ config('app.name') }}</h2>
        <h4>Reset Password Request</h4>
        <p class="lead">Click the bouton below to reset your password</strong></p>
        <p class="lead"><a class="btn btn-primary btn-sm" href="ubereats://ubereats.com/resetpwd/{{ $token }}" role="button">Reset password</a></p>
        <p>Having trouble ? <a href="mailto:support@ubereats.com">Contact us</a></p>
  </div>
@endsection