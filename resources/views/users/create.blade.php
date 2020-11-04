@extends('layouts.partials.crud')

@section('title', 'Create user')

@section('crudform')
    <h3>Ajouter un nouvel utilisateur</h3>
    @include('users.form')
@endsection