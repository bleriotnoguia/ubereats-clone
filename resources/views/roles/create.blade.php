@extends('layouts.partials.crud')

@section('title', 'Create role')

@section('crudform')
    <h3>Ajouter un role</h3>
    @include('roles.form')
@endsection