@extends('layouts.partials.crud')

    @if (Auth::user()->id == $user->id)
        @section('title', __('Edit my profile'))
    @else
        @section('title', __('Edit user'))
    @endif

@section('crudform')
    @if (Auth::user()->id == $user->id)
        <h3>Editer nom compte</h3>
    @else
    {{-- Pour le cas du super-admin --}}
        <h3>Editer l'utilisateur</h3>
    @endif
    @include('users.form')
@endsection