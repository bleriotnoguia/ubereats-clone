@extends('layouts.partials.crud')

@section('title', __('Edit payment method'))

@section('crudform')
    <h3>Editer une methode de paiement</h3>
    @include('paymentmethods.form')
@endsection