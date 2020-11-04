@extends('layouts.partials.crud')

@section('title', __('Create notation'))

@section('crudform')
    <h3>Créer une notation [ {{ isset(\Request::query()['type']) ? \Request::query()['type'] : '' }} ]</h3>
    @include('notations.form')
@endsection