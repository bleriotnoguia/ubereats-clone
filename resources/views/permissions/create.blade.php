@extends('layouts.partials.crud')

@section('title', 'Create permission')

@section('crudform')
    <h3>Ajouter une permission</h3>
    @include('permissions.form')
@endsection