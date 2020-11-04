@extends('layouts.partials.crud')

@section('title', __('Edit coupon codes'))

@section('crudform')
    <h3>Editer le coupon code : <b>{{ $promocode->code }}</b></h3>
    @if(Auth::user()->isSuperAdmin())
        <h4>De la boutique : <b>{{ $promocode->restaurant->name }}</b></h4>
    @endif
    @include('promocodes.form')
@endsection