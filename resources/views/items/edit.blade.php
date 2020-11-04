@extends('layouts.partials.crud')

@section('title', __('Edit item'))
@section('crudform')
<h3>Editer "<b>{{ str_limit($item->name, 16, '...') }}</b>" ou <a href="{{ route('items.create', $restaurant_selected->id) }}">créer un article</a></h3>
    @include('items.form')
@endsection