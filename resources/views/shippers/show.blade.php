@extends('layouts.app')

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', 'Livreurs')

@section('title_header', 'Livreur')
@section('sub_title_header', 'Détails du livreur')

@section('breadcrumbs')
    {{ Breadcrumbs::render('shippers.shippings') }}
@stop

@php
    $i = 0;
@endphp
@section('main')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{ $shipper->shippings->where('status', 'planned')->count()  }}</h3>
            <p>Livraisons pévues</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue">
        <div class="inner">
            <h3>{{ $shipper->shippings->where('status', 'in_progress')->count()  }}</h3>
            <p>Livraisons en cours</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $shipper->shippings->where('status', 'done')->count()  }}</h3>
                <p>Livraisons effectuées</p>
            </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $formatter->formatCurrency($shipper->shippings->where('status', 'done')->pluck('fee')->sum(), env('CURRENCY_CODE')) }}</h3>
                <p>De gains total</p>
            </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="box">
<div class="box-header">
    <h3 class="box-title">Toutes les livraisons de <b>{{ $shipper->full_name }}</b></h3>
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
                    <th>Livré le</th>
                    <th>Commande</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shipper->shippings as $shipping)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$shipping->shipped_at }}</td>
                    <td>{{$shipping->location}}</td>
                    <td>{{$formatter->formatCurrency($shipping->fee, env('CURRENCY_CODE'))}}</td>
                    <td>{!! $shipping->status_html !!}</td>
                    <td>{{ $shipping->shipped_at }}</td>
                    <td><a href="{{ route('orders.show', $shipping->order) }}" class="text-bold">{{$shipping->order->number}}</a></td>
                    <td><a href="{{ route('orders.show', $shipping->order) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a></td>
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
                    <th>Livré le</th>
                    <th>Commande</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
</div>
<!-- /.box-body -->
</div>
@endsection

@section('scripts')
@include('utilities.js-dataTables')
@stop