@extends('layouts.partials.crud')

@section('title', __('Edit site settings'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.site') }}
@stop

@section('crudform')

<h3>Parametre generale de l'application</h3>

@include('utilities.errors')
@include('utilities.flash')
@include('utilities.mapmodal', ['title' => 'Votre position géographique centrale'])

{!! Form::model($settings, ['method' => 'put', 'url'=>action('SettingController@updateSiteSetting')]) !!}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('site_email', __('Ubereats email')) !!}
                    {!! Form::email('site_email', null  , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('site_phone_number', __('Ubereats phone number')) !!}
                    {!! Form::text('site_phone_number', null , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('site_language_code', __('Language code')) !!}
                    {!! Form::text('site_language_code', null, ['class' => 'form-control']) !!}
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('site_currency_code', __('Currency code')) !!}
                    {!! Form::text('site_currency_code', null, ['class' => 'form-control']) !!}
                </div> --}}
                <div class="form-group">
                    {!! Form::label('shipping_fee', __('Default shipping fee')) !!}
                    <div class="input-group">
                        {!! Form::number('shipping_fee', null , ['class' => 'form-control', 'min'=>0 ]) !!}
                        <div class="input-group-addon">
                            <b>{{ $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) }}</b>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('max_simultaneous_shipments', __('Maximum number of simultaneous shipments per shipper')) !!}
                    {!! Form::number('max_simultaneous_shipments', null , ['class' => 'form-control', 'min'=>0 ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('ubereats_fee_percent', 'Reduction sur chaque transaction ( en pourcentage )') !!}
                    <div class="input-group date">
                        {!! Form::number('ubereats_fee_percent', null, ['class' => 'form-control', 'min'=>0, 'required' => 'required']) !!}
                        <div class="input-group-addon">
                            <b>%</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('site_title', __("Ubereats's slogan")) !!}
                    {!! Form::text('site_title', null  , ['class' => 'form-control']) !!}
                </div>
                <fieldset>
                    <legend>{{ __('Location address') }}</legend>
                    <p class="text-right">Choisissez la position centrale <a id="piker-location" href="#"><i class="fa fa-google" aria-hidden="true"></i>oogle map</a></p>
                    <div class="form-group">
                        {!! Form::label('service_zone_address', 'Addresse de la zone de service') !!}
                        {!! Form::text('service_zone_address', null, ['class'=>'form-control', 'id'=>'address', 'disabled'=>'disabled'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('service_zone_country', 'Pays de la zone de service') !!}
                        {!! Form::text('service_zone_country', null, ['class'=>'form-control', 'id'=>'country', 'disabled'=>'disabled'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('service_zone_postal_code', 'Postal code de la zone de service') !!}
                        {!! Form::text('service_zone_postal_code', null, ['class'=>'form-control', 'id'=>'postal-code', 'disabled'=>'disabled'] ) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('service_zone_radius', 'Rayon de service (km)') !!}
                        <div class="input-group">
                            {!! Form::number('service_zone_radius', null, ['class'=>'form-control', 'min'=>0]) !!}
                            <div class="input-group-addon">
                                <b>Km</b>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        {!! Form::hidden('service_zone_gmap_address', null, ['id' => 'gmap-address']) !!}
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 

@endsection