@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Shippers payouts'))

@section('title_header', __('Payouts'))
@section('sub_title_header', __('Shippers payouts'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('shippers_payouts') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<p class="text-left">
    <a href="{{route('users.create')}}" class="btn btn-primary" title="Ajouter un utilisateur"><i class="fa fa-plus-circle"></i> Ajouter</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Paiements des expéditeurs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Expéditeur</th>
                        <th>Phone number</th>
                        <th>Balance</th>
                        <th>Last update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shippers as $shipper)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{ $shipper->full_name }}</td>
                        <td>{{ $shipper->phone_number }}</td>
                        <td>{{ $formatter->formatCurrency($shipper->balance, env('CURRENCY_CODE')) }}</td>
                        <td>{{ isset($shipper->balance) ? $shipper->wallet->updated_at : '' }}</td>
                        <td>
                            <a href="{{ route('payouts.create', $shipper) }}" class = "btn btn-success" title="{{ __('Make a payment') }}"><i class="fa fa-money"></i></a>
                            <a href="{{ route('payouts.show', $shipper) }}" class="btn btn-primary" title="{{ __('List of transactions') }}"><i class="fa  fa-exchange"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Expéditeur</th>
                        <th>Phone number</th>
                        <th>Balance</th>\
                        <th>Last update</th>
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
@stop 