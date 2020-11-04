@extends('layouts.partials.crud')

@section('title', __('Create supplement'))

@section('crudform')
    <h3>Ajouter un supplement </h3>
    @include('supplements.form')
@endsection