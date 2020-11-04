@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Invoices list'))

@section('title_header', 'Factures')
@section('sub_title_header', 'Liste des factures')

@section('breadcrumbs')
    {{ Breadcrumbs::render('invoices') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
@hasrole('super-admin')
    {!! Form::open(['method' => 'GET', 'style' => "display: inline-block", 'route' => ['notations.index'], 'id' => 'filterForm']) !!}
        {!! Form::select('restaurant_id', array(" " => __('All') ) + App\Models\Restaurant::pluck('name', 'id')->toArray(), isset(\Request::query()['restaurant_id']) ? \Request::query()['restaurant_id'] : null , ['class' => 'form-control restaurant-select']) !!}
    {!! Form::close() !!}
@endhasrole
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Toutes les factures</b></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date d'emission</th>
                        <th>Methode de paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><a href="{{ route('orders.show', $invoice->order) }}" class="text-bold">{{$invoice->order->number}}</a></td>
                        <td>{{$invoice->order->user->full_name}}</td>
                        <td>{{$formatter->formatCurrency($invoice->total, env('CURRENCY_CODE'))}}</td>
                        <td>{!! $invoice->status_html !!}</td>
                        <td>{{$invoice->issue_date}}</td>
                        <td>{{ isset($invoice->payment) ? $invoice->payment->method : '' }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-primary" title="Details de la facture {{$invoice->number}}"><i class="fa fa-info-circle"></i></a>
                            <button type="button" class = "btn btn-danger btn-permanently-hide" title="Masquer"><i class="fa fa-times"></i></button>
                            @if(Auth::user()->isSuperAdmin() && $invoice->status == 'unpaid' && isset($invoice->payment) && $invoice->payment->payment_method->code == 'cashondelivery')
                            {!! Form::open(['method' => 'put', 'style' => "display: inline", 'route' => ['invoices.update', $invoice->id]]) !!}
                                {!! Form::hidden('status', 'paid') !!}
                                <button type="button" class="btn btn-success" onclick='allow("Voulez vous confirmer avoir reçu le paiement ?", this)' title="Confirmer le paiement"><i class="fa fa-money"></i> <i class="fa fa-check"></i></button>
                            {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date d'emission</th>
                        <th>Methode de paiement</th>
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
    <script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
    <script>
        $('.restaurant-select').select2();
        $('.restaurant-select').change(
            function (){
                $('#filterForm').attr('action', '{{ route('invoices.index') }}');
                $('#filterForm').submit();
            }
        );
    </script>
@stop 