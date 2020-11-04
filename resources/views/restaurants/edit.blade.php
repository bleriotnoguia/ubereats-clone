@extends('layouts.partials.crud')

@section('title', __('Edit shop'))

@section('crudform')
    @if (!Auth::user()->isSuperAdmin())
        <h3>Editer mon {{ !$restaurant->is_merchant ? 'restaurant' : 'commerce' }}</h3>
    @else
        <h3>Editer le {{ !$restaurant->is_merchant ? 'restaurant' : 'commerce' }}</h3>
    @endif
    @include('restaurants.form')
@endsection