@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}"> 
    <style>
    .content-wrapper{
      background-image: url({{ asset('/img/home/background.jpg') }});
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

@section('title', __('Login'))

@section('main')

<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Uber Eats</b>Log</a>
  </div>
  <div style="background-color: hsla(0, 0%, 0%, 0.5); padding-bottom: 5px; margin-bottom: 10px;" class="pb-3">
    <h3 class="text-center text-bold">Demo</h3>
    <ul>
      <li><b>Email Shop :</b> market@ubereatsclone.com</li>
      <li><b>Password Shop :</b> secret</li>
    </ul>
    <hr>
    <ul>
      <li><b>Email Admin :</b> admin@ubereatsclone.com</li>
      <li><b>Password Admin :</b> 12345678 </li>
    </ul>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">{{__('Sign in to start your session')}}</p>
    @if(session('message'))
      <div class="alert alert-danger">
        {{ session('message') }}
      </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group has-feedback">
        {{-- <input type="email" class="form-control" placeholder="Email"> --}}
        <input id="email" type="email" name="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{-- <input type="password" class="form-control" placeholder="Password"> --}}
        <input id="password" type="password" name="password" placeholder="{{__('Password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">{{__('Sign In')}}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password ?') }}
            </a>
        @endif<br>
    {{-- <a href="register.html" class="text-center">Register a new membership</a> --}}

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
@section('scripts')
<!-- iCheck -->
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection
