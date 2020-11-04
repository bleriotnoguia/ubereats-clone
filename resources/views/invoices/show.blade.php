@extends('layouts.app') 

@section('title', __('Invoice'))

@section('title_header', 'Factures')
@section('sub_title_header', $invoice->number)

@section('breadcrumbs')
    {{ Breadcrumbs::render('invoices.details') }}
@stop

@section('main')
    @include('utilities.flash')
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{ config('app.name') }}, Inc.
            <small class="pull-right">{{ __('Issue date') }} : {{ $invoice->due_date ? $invoice->issue_date->format('d/m/Y H:i') : '' }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{ __('From') }}
          <address>
            <strong>{{ str_limit($invoice->order->restaurant->name, 24, '...') }}.</strong><br>
            {{ __('Address') }} : {{ $invoice->order->restaurant->location }}<br>
            {{ __('Phone') }} : {{ $invoice->order->restaurant->phone_number }}<br>
            {{ __('Email') }} : {{ $invoice->order->restaurant->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{ __('To') }}
          <address>
            <strong>{{ $invoice->order->user->first_name. ' ' .$invoice->order->user->last_name }}</strong><br>
            {{ __('Address') }} : {{ $invoice->order->user->location }}<br>
            {{ __('Phone') }} : {{ $invoice->order->user->phone_number }}<br>
            {{ __('Email') }} : {{ $invoice->order->user->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          {{ __('Invoice number') }} : <b>{{ $invoice->number }}</b><br>
          {{ __('Order number') }} : <b>{{ $invoice->order->number }}</b><br>
          {{ __('Payment due') }} : <b>{{ $invoice->due_date }}</b><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>{{ __('Qty') }}</th>
              <th>Article</th>
              <th>Prix unitaire</th>
              <th>Description</th>
              <th>Sous total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invoice->order->orderLines as $line)
            <tr>
              <td>{{ $line->quantity }}</td>
              <td>{{ $line->model->name }}</td>
              <td>{{ $formatter->formatCurrency($line->model_price, env('CURRENCY_CODE')) }}</td>
              <td>{{ $line->model->description }}</td>
              <td>{{ $formatter->formatCurrency($line->subtotal, env('CURRENCY_CODE')) }}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">{{ __('Payment method') }} : <b>{{ $invoice->payment->method }}</b></p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Tous vos paiements vous seront transferés chaque fin du mois.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
        <p class="lead">{{ __('Payment due') }} : {{ $invoice->due_date ? $invoice->due_date->format('d/m/Y H:i') : '' }}</p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">{{ __('Subtotal') }}:</th>
                <td>{{ $formatter->formatCurrency($invoice->order->total, env('CURRENCY_CODE')) }}</td>
              </tr>
              <tr>
                <th>{{ __('Reduction') }}  
                @if(isset($invoice->order->coupon_data['discount_type']) && $invoice->order->coupon_data['discount_type'] == 'percent')
                  {{ '( '.$invoice->order->coupon_data['discount_percent'].'% )' }}
                @endif
                
                </th>
                <td>{{ $formatter->formatCurrency($invoice->order->reduction, env('CURRENCY_CODE')) }}</td>
              </tr>
              <tr>
                <th>{{ __('Shipping fee') }}:</th>
                <td>{{ $formatter->formatCurrency($invoice->order->shipping->fee, env('CURRENCY_CODE')) }}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{ $formatter->formatCurrency($invoice->order->total_to_pay, env('CURRENCY_CODE')) }}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
            @if(Auth::user()->isSuperAdmin() && $invoice->status == 'unpaid' && isset($invoice->payment) && $invoice->payment->payment_method->code == 'cashondelivery')
                {!! Form::open(['method' => 'put', 'style' => "display: inline", 'route' => ['invoices.update', $invoice->id]]) !!}
                    {!! Form::hidden('status', 'paid') !!}
        <button type="button" onclick='allow("Voulez vous confirmer avoir reçu le paiement ?", this)' class="btn btn-success"><i class="fa fa-money"></i>  {{ __('Confirm payment') }}</button>
                {!! Form::close() !!}
            @endif
          <a href="{{ Route('invoices.pdf', $invoice) }}" type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generer le PDF
          </a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
@endsection