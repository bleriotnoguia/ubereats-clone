<?php
    if($payment_method->id){
        $options = ['method' => 'put', 'url'=>action('PaymentMethodController@update', $payment_method)];
    }else {
        $options = ['method' => 'post', 'url'=>action('PaymentMethodController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('payment_methods.form') }}
@stop

{!! Form::model($payment_method, $options) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('code', 'Code') !!}
            {!! Form::text('code', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null , ['class' => 'form-control', 'rows' => 5, 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Activer / Desactiver') !!}
            {!! Form::select('Activer / Desactiver', [ 1 => 'Activer', 0 => 'Desactiver'], null , ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 