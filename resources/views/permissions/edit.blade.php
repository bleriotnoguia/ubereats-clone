@extends('layouts.partials.crud')

@section('title', 'Edit permission')

@section('crudform')
    <h3>Editer la permission</h3>
    @include('permissions.form')
@endsection