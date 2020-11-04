@extends('layouts.partials.crud')

@section('title', __('Edit password'))

@section('crudform')
    @if (Auth::user()->id == $user->id)
        <h3>Changer mon mot de passe</h3>
    @else
    {{-- Pour le cas du super-admin --}}
    <h3>Changer le mot de passe de : {{ $user->full_name }}</h3>
    @endif

@include('utilities.errors')
@include('utilities.flash')
{!! Form::model($user, ['method' => 'put', 'url'=>action('UserController@changePassword', $user)]) !!}
            <div class="form-group">
                {!! Form::label('previous_password', __('Ancien mot de passe') ) !!}
                {!! Form::password('previous_password', ['class' => 'form-control', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('new_password', 'Nouveau mot de passe') !!}
                {!! Form::password('new_password', ['class' => 'form-control', 'required'=>'required']) !!}
            </div>
            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                {!! Form::label('c_password', 'Confirmez le mot de passe') !!}
                {!! Form::password('c_password', ['class' => 'form-control', 'required'=>'required']) !!}
                {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
            </div>
        {!! Form::submit('Changer le mot de passe' , ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 
@endsection