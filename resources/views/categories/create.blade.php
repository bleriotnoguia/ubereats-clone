@extends('layouts.partials.crud')

@section('title', __('Create category'))

@section('crudform')
    <h3>Ajouter un categorie</h3>
    @include('categories.form')
@endsection