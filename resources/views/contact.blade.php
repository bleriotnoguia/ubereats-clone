@extends('layouts.partials.crud')

@section('title', __('Contact the super administrator'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('contact') }}
@stop

@section('crudform')
    <h3>Contacter l'administrateur</h3>
@include('utilities.errors')
@include('utilities.flash')

{!! Form::open(['method' => 'post', 'url'=>action('ContactController@store')]) !!}
        <div class="form-group">
            <P>Votre prenom et nom : {{ Auth::user()->full_name }}</P>
            {!! Form::hidden('name', Auth::user()->full_name) !!}
        </div>
        <div class="form-group">
            <P>Votre email : {{ Auth::user()->email }}</P>
            {!! Form::hidden('email',  Auth::user()->email) !!}
        </div>
        <div class="form-group">
            {!! Form::label('message', 'Votre message') !!}
            {!! Form::textarea('message', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 
@endsection