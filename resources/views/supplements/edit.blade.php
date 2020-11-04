@extends('layouts.partials.crud')

@section('title', __('Edit supplement'))

@section('crudform')
<h3>Editer "<b>{{ str_limit($supplement->name, 16, '...') }}</b>" ou <a href="{{ route('supplements.create', $_restaurant->id) }}">créer un supplement</a></h3>
    @include('supplements.form')
@endsection