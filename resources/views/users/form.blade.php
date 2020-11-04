<?php
    if($user->id){
        $options = ['method' => 'put', 'url'=>action('UserController@update', $user)];
    }else {
        $options = ['method' => 'post', 'url'=>action('UserController@store')];
    }
?>

@include('utilities.errors')
@include('utilities.flash')
@include('utilities.mapmodal', ['title' => 'Votre position géographique'])

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/intl-tel-input/css/intlTelInput.css') }}">
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('users.form') }}
@stop

{!! Form::model($user, $options) !!}
        <div class="row">
            <div class="col-sm-6">
                <h4>Informations sur l'utilisateur</h4>
                <div class="form-group">
                    {!! Form::label('first_name', __('Prénom') ) !!}
                    {!! Form::text('first_name', null , ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', __('Nom') ) !!}
                    {!! Form::text('last_name', null , ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <label for="document">Profile (une seule image)</label>
                <div class="dropzone" id="document-dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null , ['class' => 'form-control', 'required'=>'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}" style="display: flex; flex-direction: column;">
                    {!! Form::label('phone_number', __('Phone')) !!}
                    {!! Form::tel('phone_number', null , ['class' => 'form-control', 'required'=>'required']) !!}
                    <span id="phone-valid-msg" class="hide text-success">✓ Valid</span>
                    <span id="phone-error-msg" class="hide text-danger"></span>
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-sm-6">
                @if (Auth::user()->isSuperAdmin() && !$user->id)
                    <div class="form-group">
                        <h4>Role de l'utilisateur</h4>
                        <p class="text-danger"><i class="fa fa-info-circle"></i> Une fois la sauvegarde effectuée  il est impossible de mettre à jour le role de l'utilisateur.</p>
                        <p class="text-info"><i class="fa fa-info-circle"></i> Si vous ne selectionner aucun role, nous supposerons dans ce cas qu'il s'agit d'un simple utilisateur</p>
                        @foreach ($roles as $role)
                            <div class="form-group">
                                <label>
                                    {!! Form::radio('roles', $role, null, [(isset($userRole) && in_array($role, $userRole) ? 'checked' : '')] ) !!}
                                    {{ __('permissions.'.$role) }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    @if(Auth::user()->id == $user->id)
                    <fieldset>
                        <legend>{{ __('Location address') }}</legend>
                        <p class="text-right">Retrouvez votre position depuis <a id="piker-location" href="#"><i class="fa fa-google" aria-hidden="true"></i>oogle map</a></p>
                        <div class="form-group">
                            {!! Form::label('address', 'Votre addresse') !!}
                            {!! Form::text('country', $user->location ? $user->location : null, ['class'=>'form-control', 'id'=>'address', 'disabled'=>'disabled'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Votre pays') !!}
                            {!! Form::text('country', $user->country_name ? $user->country_name : null, ['class'=>'form-control', 'id'=>'country', 'disabled'=>'disabled'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'Votre ville') !!}
                            {!! Form::text('city', $user->city_name ? $user->city_name : null, ['class'=>'form-control', 'id'=>'city', 'disabled'=>'disabled'] ) !!}
                        </div>
                    </fieldset>
                    <div class="form-group">
                        {!! Form::label('address_description', 'Description de l\'adresse') !!}
                        {!! Form::textarea('address_description', $user->id && $user->address ? $user->address->description : null , ['class' => 'form-control', 'rows'=>'5', 'placeholder'=>'optional']) !!}
                    </div>
                        {!! Form::hidden('gmap_address', isset($user->address->gmap_address) ? json_encode($user->address->gmap_address) : null, ['id' => 'gmap-address']) !!}
                    @endif
                    @if(Auth::user()->isSuperAdmin())
                    @if($user->id)
                        <h4>Changer le mot de passe ? ( {{ __('optional') }} )</h4>
                    @else
                        <h4>Renseigner le mot de passe ( {{ __('required') }} )</h4>
                    @endif
                        <div class="form-group">
                            {!! Form::label('password', 'Mot de passe') !!}
                            {!! Form::password('password', ['class' => 'form-control', !$user->id ? 'required' : '']) !!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            {!! Form::label('c_password', 'Confirmez le mot de passe') !!}
                            {!! Form::password('c_password', ['class' => 'form-control', !$user->id ? 'required' : '']) !!}
                            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                        @if(!$user->id)
                            <div class="alert alert-info">
                                <p>Cet utilisateur recevra par email, le message confirmation de son compte</p>
                            </div>
                        @endif
                    @endif
            </div>
    </div>
        {!! Form::hidden('user_id', $user->id) !!}
        {!! Form::submit(null , ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 

@section('scripts')
    @parent

    <script src="{{ asset('adminlte/plugins/intl-tel-input/js/intlTelInput.js') }}"></script>

    <script>
        $(document).ready(function(){
            var input = document.querySelector("#phone_number");
            errorMsg = document.querySelector("#phone-error-msg"),
            validMsg = document.querySelector("#phone-valid-msg");

            // here, the index maps to the error code returned from getValidationError - see readme
            var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

            // initialise plugin
            var iti = window.intlTelInput(input, {
                // allowDropdown: false,
                // autoHideDialCode: false,
                // autoPlaceholder: "off",
                dropdownContainer: document.body,
                // excludeCountries: ["us"],
                // formatOnDisplay: false,
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                    });
                },
                hiddenInput: "full_number",
                // localizedCountries: { 'de': 'Deutschland' },
                // nationalMode: false,
                // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                // placeholderNumberType: "MOBILE",
                // preferredCountries: ['cn', 'jp'],
                separateDialCode: true,
                utilsScript: "{{ asset('adminlte/plugins/intl-tel-input/js/utils.js') }}",
            });

            var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
            };

            // on blur: validate
            input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                validMsg.classList.remove("hide");
                } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
                }
            }
            });

            // on keyup / change flag: reset
            input.addEventListener('change', reset);
            input.addEventListener('keyup', reset);
        });
    </script>
    @include('utilities.dropzone', ['model' => isset($user->id) ? $user : null])
@endsection