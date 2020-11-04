@extends('layouts.partials.crud')

@section('title', __('Edit menu'))

@section('crudform')
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Attention !</h4>
        Vos articles hériteront des modifications que vous expliquerez à un menu !
    </div>
    <h3>Editer le menu</h3>
    @include('menus.form')
@endsection