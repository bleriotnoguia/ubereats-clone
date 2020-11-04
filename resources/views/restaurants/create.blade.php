@extends('layouts.partials.crud')

@section('title', __('Create shop'))

@section('crudform')
    <h3>Créer une boutique</h3>
    @include('restaurants.form')
@endsection