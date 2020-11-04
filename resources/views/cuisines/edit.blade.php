@extends('layouts.partials.crud')

@section('title', __('Edit cuisine'))

@section('crudform')
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Attention !</h4>
        Vos articles hériteront des modifications que vous expliquerez à une cuisine !
    </div>
    <h3>Editer la cuisine</h3>
    @include('cuisines.form')
@endsection