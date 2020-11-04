@extends('layouts.partials.crud')

@section('title', __('Make a payment'))

@section('crudform')
<h3>{{ __('Amount in the wallet') }} : {{$formatter->formatCurrency($user->balance, env('CURRENCY_CODE')) }}</h3>
@if($user->hasrole('shipper'))
  <p>Paiement du livreur : <b> {{ $user->full_name }} </b></p>
@else
  <p>Paiement de la boutique : <b> {{ $user->restaurant->name }} </b></p>
@endif

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
  @if($user->hasrole('shipper'))
    {{ Breadcrumbs::render('shippers_payouts') }}
  @else
    {{ Breadcrumbs::render('shops_payouts') }}
  @endif
@stop

<div class="row">
    <div class="col-sm-6">
        {!! Form::open(['method' => 'post', 'url'=>route('payouts.store', $user)]) !!}
                <div class="form-group">
                    {!! Form::label('amount', 'Montal total') !!}
                    {!! Form::text('amount', null , ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('note', 'Notes') !!}
                    {!! Form::textarea('note', null , ['class' => 'form-control', 'rows'=>'5' ]) !!}
                </div>
                {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!} 
    </div>
    <div class="col-sm-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('Latest transactions')}} </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Transaction_id</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($user->wallet->transactions()->latest()->get()->take(5) as $transaction)
                  <tr>
                    <td>{{$transaction->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{__($transaction->type)}}</td>
                    <td>{{$transaction->hash}}</td>
                    <td>{{$formatter->formatCurrency($transaction->amount, env('CURRENCY_CODE'))}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="{{ route('payouts.show', $user) }}" class="btn btn-sm btn-info btn-flat pull-right">{{__('View All Transactions')}}</a>
            </div>
            <!-- /.box-footer -->
          </div>
    </div>
</div>
@endsection