@extends('layouts.partials.crud')

@section('title', __('Create item'))

@section('crudform')
@if(Auth::user()->isSuperAdmin())
    <h3>Ajouter un article au {{ $restaurant_selected->type }} : <a href="{{ route('restaurants.show', $restaurant_selected) }}">{{ $restaurant_selected->name }}</a></h3>
@else
    <h3>Ajouter un article </h3>
@endif
    @include('items.form')
@endsection