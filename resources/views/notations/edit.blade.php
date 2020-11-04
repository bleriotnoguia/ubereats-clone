@extends('layouts.partials.crud')

@section('title', __('Edit notation'))

@section('crudform')
        <h3>Edition : Notation de la {{ ($notation->type == "shipping") ? 'livraison de la' : '' }} commande <b>{{ $notation->order->number  }}</b></h3>
    @include('notations.form')
@endsection