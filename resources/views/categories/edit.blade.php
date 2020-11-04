@extends('layouts.partials.crud')

@section('title', __('Edit category'))

@section('crudform')
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Attention !</h4>
        Vos articles hériteront des modifications que vous expliquerez à une categorie !
    </div>
    <h3>Editer la categorie</h3>
    @include('categories.form')
@endsection