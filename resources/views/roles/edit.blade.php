@extends('layouts.partials.crud')

@section('title', 'Edit role')

@section('crudform')
    <h3>Editer le role</h3>
    @include('roles.form')
@endsection