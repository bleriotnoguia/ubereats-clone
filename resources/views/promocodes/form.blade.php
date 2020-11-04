<?php
    if($promocode->id){
        $options = ['method' => 'put', 'url'=>action('PromocodeController@update', $promocode)];
    }else {
        $options = ['method' => 'post', 'url'=>action('PromocodeController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('promocodes.form') }}
@stop

{!! Form::model($promocode, $options) !!}
    <div class="row">
        <div class="col-sm-6">
            @if($promocode->id)
                <div class="form-group">
                    <label for="coupon-name">Nom du coupon code (10 caratères max) </label>
                    <input class="form-control" required="required" {{ (isset($promocode->data->coupon_creation_type) && $promocode->data->coupon_creation_type == 'automatic') ? 'disabled' : '' }} maxlength="10" name="coupon_name" type="text" value="{{ $promocode->code }}" id="coupon-name">
                </div>
            @endif
            @if(!$promocode->id)
                <div class="form-group">
                    {!! Form::label('coupon_creation_type', 'Definir le type de création du coupon') !!}
                    {!! Form::select('coupon_creation_type', array_map("__", ['automatic'=>'Générer automatiquement', 'manual' => 'Entrer manuellement']), null , ['class' => 'form-control coupon-creation-type']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('discount_type', 'Definir un type de reduction') !!}
                    {!! Form::select('discount_type', array_map("__", ['percent'=>'Prourcentage de reduction', 'amount' => 'Montant de reduction']), null , ['class' => 'form-control discount-type']) !!}
                </div>
            @else
                <input type="hidden" name="discount_type" value="{{ $promocode->data->discount_type }}">
                <input type="hidden" name="coupon_creation_type" value="{{ $promocode->data->coupon_creation_type }}">
            @endif
            @if(!$promocode->id || $promocode->id && isset($promocode->data->discount_percent))
                <div class="form-group">
                    {!! Form::label('coupon_percent_discount', 'Pourcentage de reduction') !!}
                    <div class="input-group date">
                        {!! Form::number('coupon_percent_discount', $promocode->id && isset($promocode->data->discount_percent) ? $promocode->data->discount_percent : null , ['class' => 'form-control pull-left', 'required'=>'required']) !!}
                        <div class="input-group-addon">
                            <b>%</b>
                        </div>
                    </div>
                </div>
            @elseif($promocode->id && isset($promocode->data->discount_amount))
                <div class="form-group">
                    {!! Form::label('coupon_amount_discount', 'Montant de reduction') !!}
                    <div class="input-group date">
                        {!! Form::number('coupon_amount_discount', $promocode->id && isset($promocode->data->discount_amount) ? $promocode->data->discount_amount : null , ['class' => 'form-control pull-left', 'required'=>'required']) !!}
                        <div class="input-group-addon">
                            <b>{{ $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) }}</b>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name', 'Periode de validité') !!}
                <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" value="{{ $promocode->id ? $promocode->data->validity_date : null }}" class="form-control pull-right coupon-validity-date" name="coupon_validity_date">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                {!! Form::label('coupon_description', 'Description') !!}
                {!! Form::text('coupon_description', $promocode->id && isset($promocode->data->coupon_description) ? $promocode->data->coupon_description : null , ['class' => 'form-control coupon-description']) !!}
            </div>
            @if(!$promocode->id)
                <div class="form-group">
                    {!! Form::label('coupon_type', 'Definir à combien de client appliquer ce code coupon') !!}
                    {!! Form::select('coupon_type', array_map("__", ['all_user'=>'Tous les clients', 'some_user' => 'Définir une valeur', 'one_user'=>'Un seul']), null , ['class' => 'form-control coupon-type']) !!}
                </div>
            @else
                <input type="hidden" name="coupon_type" value="{{ $promocode->data->coupon_type }}">
            @endif
            @if($promocode->id && isset($promocode->quantity))
                <div class="form-group">
                    {!! Form::label('quantity', 'Nombre de client') !!}
                    {!! Form::text('quantity', $promocode->quantity , ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
            @endif
        </div>
    </div>
    @if(!$promocode->id)
        <input type="hidden" name="restaurant_id" value="{{ $_restaurant->id }}">
    @endif
    {!! Form::submit($promocode->id ? 'Appliquer les modifications':'Démarer la promo', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

@section('scripts')

    @parent

    <script>
        $(document).ready(function(){
            
            $('.discount-type').select2();

            $('.coupon-type').select2();
            $('.coupon-creation-type').select2();

            $('.coupon-validity-date').daterangepicker({
                timePicker: false,
                timePickerIncrement: 10,
                timePicker24Hour: true,
                // singleDatePicker: true,
                opens: "right",
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $('.discount-type').change(function () {
                // if(this.value == 'percent'){
                if (this.value == 'amount') {
                    if ($('#coupon_percent_discount')) {
                        $('#coupon_percent_discount').parent().parent().remove();
                    }
                    $('.discount-type').parent().after(
                        '<div class="form-group">' +
                        '<label for="coupon_amount_discount">Montant de reduction</label>' +
                        '<div class="input-group date">' +
                        '<input class="form-control pull-left" required="required" name="coupon_amount_discount" type="text" value="" id="coupon_amount_discount">' +
                        '<div class="input-group-addon">' +
                        '<b>FCFA</b>' +
                        '</div>' +
                        '</div>' +
                        '</div>')
                } else if (this.value == 'percent') {
                    if ($('#coupon_amount_discount')) {
                        $('#coupon_amount_discount').parent().parent().remove();
                    }
                    $('.discount-type').parent().after(
                        '<div class="form-group">' +
                        '<label for="coupon_percent_discount">Pourcentage de reduction</label>' +
                        '<div class="input-group date">' +
                        '<input class="form-control pull-left" required="required" name="coupon_percent_discount" type="text" value="" id="coupon_percent_discount">' +
                        '<div class="input-group-addon">' +
                        '<b>%</b>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                }
            });

            $('.coupon-type').change(function () {
                if (this.value == 'some_user') {
                    if ($('#quantity')) {
                        $('#quantity').parent().remove();
                    }
                    $('.coupon-type').parent().after(
                        '<div class="form-group">' +
                        '<label for="quantity">Nombre de client</label>' +
                        '<input class="form-control" required="required" name="quantity" type="text" value="" id="quantity">' +
                        '</div>')
                } else {
                    if ($('#quantity')) {
                        $('#quantity').parent().remove();
                    }
                }
            });

            $('.coupon-creation-type').change(function () {
                if (this.value == 'manual') {
                    // if ($('#coupon-name')) {
                    //     $('#coupon-name').parent().remove();
                    // }
                    $('.coupon-creation-type').parent().after(
                        '<div class="form-group">' +
                        '<label for="coupon-name">Nom du coupon code (10 caratères max) </label>' +
                        '<input class="form-control" required="required" maxlength="10" name="coupon_name" type="text" value="" id="coupon-name">' +
                        '</div>')
                } else {
                    if ($('#coupon-name')) {
                        $('#coupon-name').parent().remove();
                    }
                }
            });
        });
    </script>
@endsection