@extends('layouts.partials.crud')

@section('title', __('Create menu'))

@section('crudform')
    <h3>Ajouter un menu</h3>
    @include('menus.form')
@endsection