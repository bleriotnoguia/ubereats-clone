@extends('layouts.partials.crud')

@section('title', __('Create cuisine'))

@section('crudform')
    <h3>Ajouter un cuisine</h3>
    @include('cuisines.form')
@endsection