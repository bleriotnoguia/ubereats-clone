@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Shippings list'))

@section('title_header', 'Livraisons')
@section('sub_title_header', 'Liste des livraisons')

@section('breadcrumbs')
    {{ Breadcrumbs::render('shippings') }}
@stop

@section('main')
@php

$models = $shippingMen;
$i = 0;

if(!Auth::user()->isSuperAdmin()){
    $shippings = \App\Models\Shipping::whereIn('order_id', $_restaurant->orders->pluck('id')->toArray())->latest()->get();
}

$userDataToDisplay = [ 
        'first_name' => 'Prenom', 
        'last_name' => 'Nom', 
        'email' => 'Email',
        'phone_number' => "Numéro de télephone",
        'country_name' => 'Pays',
        'city_name' => 'Vile',
        'address_description' => 'Description de l\'adresse'
     ];
@endphp

@component('utilities.modalhtml')
    @slot('title')
        Informations sur le livreur
    @endslot
    @foreach ($userDataToDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent

@include('utilities.flash')
@hasrole('super-admin')
    {!! Form::open(['method' => 'GET', 'style' => "display: inline-block", 'route' => ['notations.index'], 'id' => 'filterForm']) !!}
        {!! Form::select('restaurant_id', array(" " => __('All') ) + App\Models\Restaurant::pluck('name', 'id')->toArray(), isset(\Request::query()['restaurant_id']) ? \Request::query()['restaurant_id'] : null , ['class' => 'form-control restaurant-select']) !!}
    {!! Form::close() !!}
@endhasrole
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Toutes les livraisons</b></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Date de livraison</th>
                        <th>Lieu</th>
                        <th>Frais</th>
                        <th>Statut</th>
                        <th>Modifié le</th>
                        <th>Nom du livreur</th>
                        <th>Commande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippings as $shipping)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$shipping->shipped_at }}</td>
                        <td>{{$shipping->location}}</td>
                        <td>{{$formatter->formatCurrency($shipping->fee, env('CURRENCY_CODE'))}}</td>
                        <td>{!! $shipping->status_html !!}</td>
                        <td>{{ $shipping->updated_at }}</td>
                        <td>
                            @if(isset($shipping->user))
                            {{ $shipping->user->full_name }}
                            <a href="#" onclick="showModal({{ $shipping->user_id }})"><i class="fa fa-plus-circle"></i></a>
                            @endif
                        </td>
                        <td><a href="{{ route('orders.show', $shipping->order) }}" class="text-bold">{{$shipping->order->number}}</a></td>
                        <td>
                            <a href="{{ route('orders.show', $shipping->order) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                            <button type="button" class = "btn btn-danger btn-permanently-hide" title="Masquer"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Frais</th>
                        <th>Statut</th>
                        <th>Modifié le</th>
                        <th>Nom du livreur</th>
                        <th>Commande</th>
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
    <script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.restaurant-select').select2();
            $('.restaurant-select').change(
                function (){
                    $('#filterForm').attr('action', '{{ route('shippings.index') }}');
                    $('#filterForm').submit();
                }
            );
        });
    </script>
@stop 