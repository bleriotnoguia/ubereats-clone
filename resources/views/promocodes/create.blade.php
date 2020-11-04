@extends('layouts.partials.crud')

@section('title', __('Create coupon codes'))

@section('crudform')
    <h3>Créer un code coupon </strong></h3>
    @include('promocodes.form')
@endsection