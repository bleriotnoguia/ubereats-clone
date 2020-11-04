<div id="us6-dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $title ?? 'Chose position' }}</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Adresse:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="us3-address"/>
                        </div>
                    </div>
                    <div id="us3" style="width: 100%; height: 400px;"></div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="m-t-small">
                        <div class="col-sm-3">
                            <input type="hidden" class="form-control" style="width: 110px" id="us3-lat"/>
                        </div>
                        <div class="col-sm-3">
                            <input type="hidden" class="form-control" style="width: 110px" id="us3-lon"/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div id="msg-error" class="alert-error hide">
                Impossible de créer votre entreprise hors de notre zone de service
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <button type="button" id="add-coordonate" class="btn btn-primary">Selectioner</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@php
    use \App\Models\Setting;
@endphp

@section('scripts')

    @parent
    
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCuKv6z2AU5ll_w0KuXfy-cZuYq7E3ADh4&sensor=false&libraries=places"></script>
    <script src="{{ asset('js/locationpicker.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            /**
             * Element for locaction piker
             */
             var lng = {{ isset($model->id) && $model->longitude ? $model->longitude : Setting::get('service_zone_longitude') }}, 
            lat = {{ isset($model->id) && $model->latitude ? $model->latitude : Setting::get('service_zone_latitude') }};
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

            function showPosition(position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
            }

            $('#us3').locationpicker({
                location: {
                    latitude: lat,
                    longitude: lng
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                enableReverseGeocode: true,
                draggable: true,
                // must be undefined to use the default gMaps marker
                markerIcon: undefined
            });

            if ($('#resto-form').length > 0) {
                $("#add-coordonate").attr('disabled', true);
                $("#us3-lat, #us3-lon").change(function () {
                    var lat = $('#us3-lat').val(), lng = $('#us3-lon').val();
                    if (canICreateCompany(lat, lng)) {
                        $("#add-coordonate").attr('disabled', false);
                        $("#msg-error").addClass('hide');
                    } else {
                        $("#add-coordonate").attr('disabled', true);
                        $("#msg-error").removeClass('hide');
                    }
                });

            }

            function canICreateCompany(lat, Lng) {
                // *p1 et ray*  merci de remplacer par leur valeurs respectives
                //NB tu peux encore verifier ces valeurs fournie avant la creation du resto
                var ray = {{ Setting::get('service_zone_radius') }};
                var p1 = {lat: {{ Setting::get('service_zone_latitude') }}, lng: {{ Setting::get('service_zone_longitude') }}}, p2 = {lat: lat, lng: Lng};

                if (getDistance(p1, p2) > ray) {
                    return false
                } else {
                    return true
                }
            }

            var rad = function (x) {
                return x * Math.PI / 180;
            };

            var getDistance = function (p1, p2) {
                var R = 6378137; // Earth’s mean radius in meter
                var dLat = rad(p2.lat - p1.lat);
                var dLong = rad(p2.lng - p1.lng);
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
                    Math.sin(dLong / 2) * Math.sin(dLong / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return d / 1000; // returns the distance in K meter
            };

            $('#us6-dialog').on('shown.bs.modal', function () {
                $('#us3').locationpicker('autosize');
            });

            $('#piker-location').click(function (e) {
                e.preventDefault();
                $('#us6-dialog').modal('show');

            })
            $('#add-coordonate').click(function (e) {
                e.preventDefault()
                // $("#longitude").val($("#us3-lon").val());
                // $("#latitude").val($("#us3-lat").val());
                $('#us6-dialog').modal('hide');
                let geocoder = new google.maps.Geocoder();
                let latLng = new google.maps.LatLng($("#us3-lat").val(), $("#us3-lon").val());
                geocoder.geocode({'latLng': latLng}, (results, status) => {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $("#address").val(results[0].formatted_address);
                        $('#gmap-address').val(JSON.stringify(results[0]));
                        $("#country").val(results[0].address_components.find(
                            function (item) {
                                return item.types.find(function (type) {
                                    return type == 'country';
                                });
                            }
                        ).long_name);
                        $("#city").val(results[0].address_components.find(
                            function (item) {
                                return item.types.find(function (type) {
                                    return type == 'locality';
                                });
                            }
                        ).long_name);

                        $("#postal-code").val(results[0].address_components.find(
                            function (item) {
                                return item.types.find(function (type) {
                                    return type == 'postal_code';
                                });
                            }
                        ).long_name);
                    }
                });

            });
        });
    </script>
@endsection