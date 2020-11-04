@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Customers list'))

@section('title_header', 'Clients')
@section('sub_title_header', 'Liste des clients')

@section('breadcrumbs')
    {{ Breadcrumbs::render('customers') }}
@stop

@section('main')

@php
$models = $customers;
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
        Détails du client
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}">default text</td>
        </tr>
    @endforeach
@endcomponent

@include('utilities.flash')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les clients</h3>
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
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$customer->first_name}}</td>
                        <td>{{$customer->last_name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->phone_number}}</td>
                        <td>{{$customer->created_at->format('d/m/Y à H:i')}}</td>
                        <td>{!! $customer->status_html !!}</td>
                        <td>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $customer->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                            <a href="{{ route('customers.orders', $customer) }}" class="btn btn-primary" title="Liste des commandes"><i class="fa fa-cubes"></i></a>
                            @if (Auth::user()->isSuperAdmin())
                                <a href="{{ route('users.edit', $customer) }}" class="btn btn-primary" title="Editer"><i class="fa fa-pencil"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['users.destroy', $customer->id]]) !!}
                                <button type="button" onclick='allow("Confirmez vous la suppresion de cet utilisateur ?", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                                <span data-toggle="tooltip" data-placement="top" title="Bloquer / Debloquer">
                                    <input type="checkbox" class="js-switch"
                                           {{ $customer->is_enable ? 'checked' : '' }} data-user-id={{$customer->id}} />
                                </span>
                            @endif
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