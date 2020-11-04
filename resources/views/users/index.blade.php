@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Users list'))

@section('title_header', 'Administrateurs')
@section('sub_title_header', 'Liste des administrateurs')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@stop

@section('main')

@php
$models = $users;
// Numéro dans la table
$i = 0;
// les valeurs qui seront affichées dans le modal(bootstrap)
$toDisplay = [ 
    'first_name' => 'Prenom', 
    'last_name' => 'Nom', 
    'email' => 'Email',
    'phone_number' => "Numéro de télephone",
    'location' => 'Emplacement',
    'country_name' => 'Pays',
    'city_name' => 'Vile',
    'address_description' => 'Description de l\'adresse'
 ];
@endphp

@component('utilities.modalhtml')
    @slot('title')
        Information sur l'administrateur
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}">default text</td>
        </tr>
    @endforeach
@endcomponent

@include('utilities.flash')
{{-- <p class="text-left">
    <a href="{{route('users.create')}}" class="btn btn-primary" title="Ajouter un utilisateur"><i class="fa fa-plus-circle"></i> Ajouter</a>
</p> --}}
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les administrateurs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom & prenom</th>
                        <th>Boutique</th>
                        <th>Email</th>
                        <th>Tel</th>
                        <th>Inscrit le</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$user->full_name}}</td>
                        <td>
                            @if ($user->restaurant)
                                <a href="{{ route('restaurants.show', $user->restaurant) }}">{{ str_limit($user->restaurant->name, 15, '...') }}</a>
                            @else
                                Aucune
                            @endif
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->created_at->format('d/m/Y à H:i')}}</td>
                        <td>{!! $user->status_html !!}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary" title="Editer"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $user->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['users.destroy', $user->id]]) !!}
                            <button type="button" onclick='allow("Confirmez vous la suppresion de cet utilisateur ?", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Bloquer / Debloquer">
                                <input type="checkbox" class="js-switch"
                                       {{ $user->is_enable ? 'checked' : '' }} data-user-id={{$user->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom & prenom</th>
                        <th>Boutique</th>
                        <th>Email</th>
                        <th>Tel</th>
                        <th>Inscrit le</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@stop()
@section('scripts')
@include('utilities.js-dataTables')
    @include('utilities.modalscript')
    @include('users.blockscript')
@endsection 