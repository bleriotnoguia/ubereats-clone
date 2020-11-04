@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Payments list'))

@section('title_header', 'Paiements')
@section('sub_title_header', 'Liste des paiements')

@section('breadcrumbs')
    {{ Breadcrumbs::render('payments') }}
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
        <h3 class="box-title">Tous les paiements</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Facture</th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Méthode de paiement</th>
                        <th>ID paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><a href="{{ route('invoices.show', $payment->invoice) }}" class="text-bold">{{$payment->invoice->number}}</a></td>
                        <td><a href="{{ route('orders.show', $payment->invoice->order) }}" class="text-bold">{{$payment->invoice->order->number}}</a></td>
                        <td>{{$payment->user->full_name}}</td>
                        <td>{{$formatter->formatCurrency($payment->amount_paid, env('CURRENCY_CODE'))}}</td>
                        <td>{!! $payment->status_html !!}</td>
                        <td>{{$payment->method}}</td>
                        <td>{{$payment->payment_id}}</td>
                        <td>
                            <button type="button" class = "btn btn-danger btn-permanently-hide" title="Masquer"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Facture</th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Méthode de paiement</th>
                        <th>ID paiement</th>
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
                $('#filterForm').attr('action', '{{ route('payments.index') }}');
                $('#filterForm').submit();
            }
        );
    </script>
@stop 