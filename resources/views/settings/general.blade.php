@extends('layouts.partials.crud')

@section('title', __('Edit general settings'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.general') }}
@stop

@section('crudform')
    <h3>Parametre generale de l'application</h3>
    @include('utilities.errors')
    @include('utilities.flash')
    {!! Form::model($settings, ['method' => 'put', 'url'=>action('SettingController@updateGeneralSetting')]) !!}
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        Paypal configuration
                    </legend>

                    <div class="form-group">
                        {!! Form::label('paypal_client_label', 'PAYPAL CLIENT ID : ') !!}
                        {!! Form::text('PAYPAL_CLIENT_ID', env('PAYPAL_CLIENT_ID'), ['class' => 'form-control', '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('paypal_enviroment_label', 'Paypal Environement key : ') !!}
                        {!! Form::text('PAYPAL_ENVIROMENT', env('paypal_enviroment'), ['class' => 'form-control', '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('paypal_sanbox_label', 'Mode test : ') !!}
                        {!! Form::checkbox('PAYPAL_SANBOX', env('paypal_sanbox'), ['class' => 'form-control', '']) !!}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                        Stripe configuration
                    </legend>
                    <div class="form-group">
                        {!! Form::label('stripe_key_label', 'STRIPE KEY :') !!}
                        {!! Form::text('STRIPE_KEY', env('stripe_key'), ['class' => 'form-control', '']) !!}
                    </div>
                </fieldset>
                {{-- <fieldset>
                    <legend>
                        Code de la devise
                    </legend>
                    <div class="form-group">
                        {!! Form::label('currency_code_label', 'CURRENCY CODE: ') !!}
                        {!! Form::text('CURRENCY_CODE', env('CURRENCY_CODE'), ['class' => 'form-control', '']) !!}
                    </div>
                </fieldset> --}}
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        Google Map configuration
                    </legend>
                    <div class="form-group">
                        {!! Form::label('google_map_api_key_label', 'GOOGLE MAP API KEY: ') !!}
                        {!! Form::text('GOOGLE_MAP_API_KEY', env('google_map_api_key'), ['class' => 'form-control', '']) !!}
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>
                        OneSignal configuration
                    </legend>
                    <div class="form-group">
                        {!! Form::label('one_signal_label', 'ONESIGNAL API: ') !!}
                        {!! Form::text('ONE_SIGNAL_KEY', env('ONE_SIGNAL_KEY') , ['class' => 'form-control', '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sender_id_label', 'SENDER ID : ') !!}
                        {!! Form::text('ONE_SIGNAL_SENDER_ID', env('ONE_SIGNAL_SENDER_ID') , ['class' => 'form-control', '']) !!}
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit("Appliquer les modifications" , ['class' => 'btn btn-warning']) !!}
        </div>
    {!! Form::close() !!} 
@endsection