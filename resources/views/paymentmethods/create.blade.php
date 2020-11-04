@extends('layouts.partials.crud')

@section('title', __('Add payment method'))

@section('crudform')
    <h3>Ajouter une methode de paiement</h3>
    @include('paymentmethods.form')
@endsection