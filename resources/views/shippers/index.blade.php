@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Shippers list'))

@section('title_header', 'Expéditeurs')
@section('sub_title_header', 'Liste des expéditeurs')

@section('breadcrumbs')
    {{ Breadcrumbs::render('shippers') }}
@stop

@section('main')

@php
$models = $shippers;
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
        Détails de l'expéditeur
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent

@include('utilities.flash')
{{-- <p class="text-left">
    <a href="{{route('shippers.create')}}" class="btn btn-primary">Ajouter</a>
</p> --}}
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les expéditeurs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Tel</th>
                        <th>Inscrit le</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippers as $shipper)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$shipper->first_name}}</td>
                        <td>{{$shipper->last_name}}</td>
                        <td>{{$shipper->email}}</td>
                        <td>{{$shipper->phone_number}}</td>
                        <td>{{$shipper->created_at->format('d/m/Y à H:i')}}</td>
                        <td>{!! $shipper->status_html !!}</td>
                        <td>
                            <a href="{{ route('users.edit', $shipper) }}" class="btn btn-primary" title="Editer"><i class="fa fa-pencil"></i></a>
                            <a href="{{ route('shippers.show', $shipper) }}" class="btn btn-primary" title="Livraisons"><i class="fa fa-cubes"></i></a>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $shipper->id }})" title="Details"><i class="fa fa-fw fa-info-circle"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['users.destroy', $shipper->id]]) !!}
                            <button type="button" class = "btn btn-danger" onclick='allow("Confirmer vous la suppression de cet utilisateur", this, true)' title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Bloquer / Debloquer">
                                <input type="checkbox" class="js-switch"
                                       {{ $shipper->is_enable ? 'checked' : '' }} data-user-id={{$shipper->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Tel</th>
                        <th>Inscrit le</th>
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