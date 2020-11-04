@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Shops payouts'))

@section('title_header', __('Payouts'))
@section('sub_title_header', __('Shops payouts'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('shops_payouts') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Paiements des boutiques</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Boutique</th>
                        <th>Type</th>
                        <th>Phone number</th>
                        <th>Balance</th>
                        <th>Last update</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->is_merchant ? 'commerce' : 'restaurant' }}</td>
                        <td>{{ $restaurant->phone_number }}</td>
                        <td>{{ $formatter->formatCurrency($restaurant->user->balance, env('CURRENCY_CODE')) }}</td>
                        <td>{{ isset($restaurant->user->balance) ? $restaurant->user->wallet->updated_at : '' }}</td>
                        <td>
                            <a href="{{ route('payouts.create', $restaurant->user) }}" class = "btn btn-success" title="{{ __('Make a payment') }}"><i class="fa fa-money"></i></a>
                            <a href="{{ route('payouts.show', $restaurant->user) }}" class="btn btn-primary" title="{{ __('List of transactions') }}"><i class="fa  fa-exchange"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Boutique</th>
                        <th>Type</th>
                        <th>Phone number</th>
                        <th>Balance</th>
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