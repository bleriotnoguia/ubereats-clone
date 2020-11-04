@extends('layouts.app')

@section('main')
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead">Your account was successfully <strong>confirmed !</strong></p>
        <p>Go back to {{ config('app.name') }} app and login with your email and password </p>
        <hr>
        <p>
        Having trouble ? <a href="mailto:support@ubereats.com">Contact us</a>
        </p>
        <p class="lead">
        <a class="btn btn-primary btn-sm" href="ubereats://ubereats.com/" role="button">Go back to {{ config('app.name') }} app</a>
        </p>
  </div>
@endsection