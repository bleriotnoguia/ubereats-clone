@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}"/>
    <style>
        #map-zone {
            border: 2px solid cornflowerblue;
            height: 400px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        #shipping {
            background: #fff;
            /* padding: 15px; */
        }
    </style>
@stop

@section('title', __('Order details'))

@section('title_header', 'Commande')
@section('sub_title_header', 'Détails de la commande')
@section('breadcrumbs')
    {{ Breadcrumbs::render('orders.details') }}
@stop
@section('main')
    @include('orders.inputmodalcancel')
    @include('orders.inputmodaldelay')
    @include('utilities.flash')
    @include('utilities.errors')
    <p>
        @if($order->status == "pending" || $order->status == "confirmed")
            {!! Form::open([
                'method' => 'put',
                'style' => "display: inline",
                'route' => ['orders.update', $order->id]
                ]) !!}
            {!! Form::hidden('status', 'ready') !!}
            <button type="button" title="Prête pour la prise en charge"
                    onclick='allow("Votre commande est-elle déjà prête ?", this)' class="btn btn-primary"><i
                        class="fa fa-check"></i> Prête pour la prise en charge
            </button>
            {!! Form::close() !!}
        @endif

        @if ($order->status == "pending")
            {!! Form::open([
              'method' => 'put',
              'style' => "display: inline",
              'route' => ['orders.update', $order->id]
              ]) !!}
            {!! Form::hidden('status', 'confirmed') !!}
            <button type="button" title="Confirmer" onclick='allow("Voulez prendre en charge cette commande ?", this)'
                    class="btn btn-success"><i class="fa fa-check"></i> Confirmer
            </button>
            {!! Form::close() !!}
            <button title="Annuler" class="btn btn-danger submitBtn" data-order-id={{ $order->id }} data-toggle='modal'
                    data-target='#cancelOrderModal'><i class="fa fa-times"></i></button>
        @endif
        @if ($order->status == "ready")
            {!! Form::open([
              'method' => 'put',
              'style' => "display: inline",
              'route' => ['orders.update', $order->id]
              ]) !!}
            {!! Form::hidden('status', 'in_shipment') !!}
            <button type="button" title="Livraison en cours"
                    onclick='allow("Le livreur a t-il récupéré la commande ?", this)' class="btn btn-success"><i
                        class="fa fa-check"></i> Livraison en cours
            </button>
            {!! Form::close() !!}
        @endif
        @if($order->status != "ready" && $order->delay_added == null)
            <button type="submit" title="Retarder" class="btn btn-warning submitDelayBtn"
                    data-order-id={{ $order->id }} data-toggle='modal' data-target='#delayOrderModal'><i
                        class="fa fa-clock-o"></i></button>
        @elseif($order->delay_added != null)
            <span class="label label-warning"
                  title="{!! 'Retardé de '.(new \DateTime($order->delay_added))->format('i').' minutes' !!}">
        <i class="fa fa-clock-o"></i> {{ (new \DateTime($order->delay_added))->format('i') }} minutes
    </span>
        @endif
        <a title="Télécharger en pdf" href="{{ Route('orders.pdf', $order) }}" class="btn btn-primary"><i
                    class="fa fa-download"></i></a>
    </p>
    <div class="container-fluid">
        <div id="shipping" class="row ">
            <!-- /.col -->
            <div class="col-md-6">
                <div style="padding: 1rem 2rem">
                    <h3>Détails de la commande</h3>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th colspan="2">Informations sur le client</th>
                        </tr>
                        <tr>
                            <td>Nom du client</td>
                            <td>{{ $order->user->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Email du client</td>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Numero du client</td>
                            <td>{{ $order->user->phone_number }}</td>
                        </tr>
                        <tr>
                            <td>Adresse du client</td>
                            <td>{{ $order->user->location }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Articles de la commande</th>
                        </tr>
                        @foreach ($order->orderLines as $line)
                            <tr>
                                <td title="{{$line->model->name}}">{{ str_limit($line->model->name, 30, "...").' * '.$line->quantity }}</td>
                                <td>{{ $formatter->formatCurrency($line->subtotal, env('CURRENCY_CODE')) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">Informations sur la commande</th>
                        </tr>
                        <tr>
                            <td>Sous Total</td>
                            <td class="total">{{$formatter->formatCurrency($order->total, env('CURRENCY_CODE'))}}</td>
                        </tr>
                        <tr>
                            <td>Frais de livraison</td>
                            <td class="shipping_fee">{{isset($order->shipping) ? $formatter->formatCurrency($order->shipping->fee, env('CURRENCY_CODE')) : ''}}</td>
                        </tr>
                        <tr>
                            <td>Réduction</td>
                        <td class="reduction">{{ $formatter->formatCurrency($order->reduction, env('CURRENCY_CODE')) }}
                            @if($order->coupon_data) 
                            <i class="fa fa-question-circle text-primary" data-toggle="tooltip" title="{!! $order->coupon_data ? "Code : ".$order->coupon_data['code']." - Type de coupon : ".__($order->coupon_data['discount_type']) : "" !!}"></i>
                            @endif 
                        </td>
                        </tr>
                        <tr>
                            <td>Total à payer</td>
                            <td class="total_to_pay">{{ $formatter->formatCurrency($order->total_to_pay, env('CURRENCY_CODE')) }}</td>
                        </tr>
                        <tr>
                            <td>Date de création</td>
                            <td class="created_at">{{$order->created_at->format('d/m/Y H:i')}}</td>
                        </tr>
                        <tr>
                            <td>Etat</td>
                            <td class="status">{!! $order->status_html !!}</td>
                        </tr>
                        <tr>
                            <td>Addresse de livraison</td>
                            <td>{{ $order->shipping->location }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
    
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div style="padding: 1rem 2rem">
                    <h3>Livraison</h3>
                    @php
                    $btn_ship_c = ($order->status == 'in_shipment' || $order->status == 'shipped');
                        if($order->shipping->user){
                            $models = collect([$order->shipping->user]);
                        }else{
                            $models = collect([]);
                        }
                        // Numéro dans la table
                        $toDisplay = [
                          'first_name' => 'Prenom',
                          'last_name' => 'Nom',
                          'email' => 'Email',
                          'phone_number' => "Numéro de télephone",
                          'country_name' => 'Pays',
                          'city_name' => 'Vile',
                          'address_description' => 'Description de l\'adresse'
                      ];
                    @endphp
                    @component('utilities.modalhtml')
                        @slot('title')
                            Information sur le livreurs
                        @endslot
                        @foreach ($toDisplay as $key => $value)
                            <tr>
                                <th>{{ $value }}</th>
                                <td class="{{ $key }}">default text</td>
                            </tr>
                        @endforeach
                    @endcomponent
                    @if($order->shipping->user && $order->status == 'in_shipment')
                        <div>
                            <div id="traking-option">
                                <button class="btn btn-primary" id="start-tracking">Suivre le livreur</button>
                                <button class="btn btn-danger" id="end-tracking">Arreter le traking</button>
                            </div>
                            {{--
                                                                <div>
                                                                    <p>
                                                                        <button class="btn btn-warning" id="bnt-location">Demo tracker</button>
                                                                        Longitude : <span id="long"></span>
                                                                        Latitude : <span id="lat"></span>
                                                                    </p>
                                                                </div>--}}
                            <p>
                                <strong><i class="fa fa-pencil margin-r-5"></i> Suivie de la position du livreur
                                    ayant cette commande</strong>
                            </p>
                            <div id="map-zone">
    
                            </div>
                        </div>
                    @endif
                    <div>
                        <p>
                            <strong><i class="fa fa-pencil margin-r-5"></i>Rechercher un livreur si vous voulez
                                faire une assignation direct</strong>
                        </p>
                        {!! Form::model($order, ['method' => 'put', 'url'=>action('ShippingController@update', $order->shipping)]) !!}
                        <div class="form-group">
                            {!! Form::select('shipper_id', $order->shipping->user ? [$order->shipping->user->id => $order->shipping->user->full_name] : [], null, ['class' => 'form-control ajax-users-search', 'required'=>'required', 'style'=>'width: 100%', $btn_ship_c ? 'disabled' : '']) !!}
                        </div>
                        <button type="button"
                                onclick='allow("Confirmez vous l attribution de cette commande ({{ $order->number }}) a ce livreur ?", this)'
                                class="btn btn-primary" title="Enregistrer l'attribution" {{ $btn_ship_c ? 'disabled' : '' }}><i
                                    class="fa fa-check"></i> Enregistrer
                        </button>
                        {!! Form::close() !!}
                    </div>
                    @if($order->shipping->user)
                        @php $shipper = $order->shipping->user @endphp
                        <hr>
                        <p>Livreur qui s'occupe (ou s'occupera) de la commande</p>
                        <hr>
                        <!-- shipper list -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm"
                                     src="{{ asset($order->shipping->user->profile_img) }}" alt="User Image">
                                <span class="username">
                                            <a href="#"
                                               onclick="showModal({{ $order->shipping->user->id }})">{{ $order->shipping->user->full_name }}</a>
                                            <div class="pull-right">
                                            <a href="#" class="btn btn-info" title="Details"
                                               onclick="showModal({{ $order->shipping->user->id }})"><i
                                                        class="fa fa-info"></i> Details</a>
                                                {!! Form::model($order, ['method' => 'put', 'style' => "display: inline", 'url'=>action('ShippingController@update', $order->shipping)]) !!}
                                                    {!! Form::hidden('shipper_id', null) !!}
                                                    <button type="button"
                                                {{ $btn_ship_c ? 'disabled' : '' }}
                                                            onclick='allow("Retirer la commande au livreur ?", this)'
                                                            class="btn btn-danger" title='Retirer'><i class="fa fa-close"></i> Retirer</button>
                                                {!! Form::close() !!}
                                            </div>
                                        </span>
                                <span class="description">Inscrit le {{ $order->shipping->user->created_at->format('d M Y') }}</span>
                            </div>
                            <!-- /.user-block -->
                        </div>
                        <!-- /.shipper list -->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
    <script src="{{ asset('adminlte/plugins/iCheck/iCheck.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuKv6z2AU5ll_w0KuXfy-cZuYq7E3ADh4"></script>
    <script>

        $(document).ready(function () {

            $(".ajax-users-search").select2({
                ajax: {
                    url: "{{ route('search.shippers') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            term: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.users,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: '{{ __ ("Search for shipper [ enter his name ... ]") }}',
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatUser,
                templateSelection: formatUserSelection
            });

            function formatUser(user) {
                console.log(user);
                if (user.loading) {
                    return 'Searching . . .';
                    // return user.text;
                }

                console.log(user);
                var markup = "<div class='select2-result-user clearfix'>" +
                    "<div class='select2-result-user__avatar'><img src='" + user.profile_img + "' /></div>" +
                    "<div class='select2-result-user__meta'>" +
                    "<div class='select2-result-user__title'>" + user.full_name + "</div>" +
                    "<div class='select2-result-user__description'>Inscrit le " + user.created_at + "</div>" +
                    "</div>";

                return markup;
            }

            function formatUserSelection(user) {
                return user.full_name || user.text;
            }

            $('.timepicker').timepicker({
                defaultTime: false,
                showInputs: false,
                showMeridian: false
            });

            $('input[name=cancellation_reason]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name=delay_added]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            // Google map tracker position


            var lineCoordinates = [];
            const restoLat ={{$order->restaurant->address->gmap_address['geometry']['location']['lat']}},
                restoLng = {{$order->restaurant->address->gmap_address['geometry']['location']['lng']}};

            const latLngResto = new google.maps.LatLng(restoLat, restoLng);
            var data;
            var map;

            $('#traking-option #end-tracking').attr('disabled', true);
            $('#traking-option #start-tracking').click(function (e) {
                e.preventDefault();
                startTrakingDeamon();
                $('#traking-option #start-tracking').attr('disabled', true);
                $('#traking-option #end-tracking').attr('disabled', false);
            });

            $('#traking-option #end-tracking').click(function (e) {
                e.preventDefault();
                killTrakingDeamon();
                $('#traking-option #start-tracking').attr('disabled', false);
                $('#traking-option #end-tracking').attr('disabled', true);

            })

            $('#map-zone').on('ready', launchMap(latLngResto));

            function launchMap(latLngResto) {

                map = new google.maps.Map(document.getElementById('map-zone'), {
                    zoom: 18,
                    center: latLngResto
                });

                var marker = new google.maps.Marker({
                    map: map,
                    position: latLngResto,
                    animation: "bounce",
                    title: 'Position du restaurant',
                });
                addInfoWindowToMarker(marker);
                showCostumer();
            }

            function updateMap(data) {
                lat = parseFloat(data.latitude);
                long = parseFloat(data.longitude);
                const latLngOrder = new google.maps.LatLng(lat, long);
                map.setCenter({lat: lat, lng: long, alt: 0});
                var marker = new google.maps.Marker({
                    map: map,
                    position: latLngOrder,
                    animation: "bounce",
                    title: 'Position du livreur',
                });
                addInfoWindowToMarker(marker);
                startNavigating(latLngResto,latLngOrder)
            }


           function startNavigating(latLngOrigin, latLngDest) {

                const directionsService = new google.maps.DirectionsService;
                const directionsDisplay = new google.maps.DirectionsRenderer;

                directionsDisplay.setMap(map);
                directionsDisplay.setPanel(this.directionsPanel.nativeElement);

                directionsService.route({
                    origin: latLngOrigin,
                    destination: latLngDest,
                    travelMode: google.maps.TravelMode.DRIVING
                }, (res, status) => {

                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(res);
                    } else {
                        console.warn(status);
                    }

                });

            }

            function showCostumer(){
                const custumerLat ={{$order->shipping->address['gmap_address']['geometry']['location']['lat']}},
                    custumerLng = {{$order->shipping->address['gmap_address']['geometry']['location']['lng']}};

                const latLngCust = new google.maps.LatLng(custumerLat, custumerLng);
                var marker = new google.maps.Marker({
                    map: map,
                    position: latLngCust,
                    animation: "bounce",
                    title: 'Position du client',
                });
                addInfoWindowToMarker(marker);
            }

            function  addInfoWindowToMarker(marker) {
                const infoWindowContent = '<div id="content">' + marker.title + '</div>';
                const infoWindow = new google.maps.InfoWindow({
                    content: infoWindowContent
                });
                marker.addListener('click', () => {
                    infoWindow.open(this.map, marker);
                });
            }

            var takingTag;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            function startTrakingDeamon() {
                takingTag = setInterval(() => {
                    var order_id ={{$order->id}};
                    $.ajax({
                        type: "POST",
                        url: "{{ route('order.position') }}",
                        data: {
                            _token: CSRF_TOKEN, order_id: order_id
                        },
                        dataType: "json",

                        success: function (response) {
                            if (response) {
                                updateMap(response);
                            }
                        },

                        error: function () {
                        }

                    });

                }, 5000);
            }

            function killTrakingDeamon() {
                clearInterval(takingTag);
            }


            /*
                    Pusher.logToConsole = true;

                    var pusher = new Pusher('05cb64d8022e9d4227b9', {
                        cluster: 'mt1',
                        forceTLS: true
                    });

                    var channel = pusher.subscribe('App.Models.Shipping.5');
                    channel.bind('send.location', function(data) {
                        console.log('Data : ' + JSON.stringify(data));
                        data = data.location;
                        $('#map-zone', updateMap(data));
                    });
            */

            // End Google map

        });

        $('.submitBtn').click(function () {
            /* when the button#submitBtn is clicked, we update the action of the #rejectForm */
            var orderId = $(this).data('order-id');
            $('#rejectForm').attr('action', '{{ route('orders.index') }}' + '/' + orderId);
            $('.message-title').val('');
            $('.message-details').val('');
        });


        $('#submit').click(function () {
            /* when the submit button in the modal is clicked, submit the form */
            $('#rejectForm').submit();
        });

        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var lat = 9.085;
        var long = 8.6783;

        $('#long').text(long);
        $('#lat').text(lat);

        $('#bnt-location').on("click", function () {
            setInterval(() => {
                lat = lat + 0.05;
                long = long + 0.03;
                // function() {
                var toggleState = {
                    _token: CSRF_TOKEN,
                    latitude: lat,
                    longitude: long,
                    shipper_id: 5
                };
                var _this = $(this);
                $.ajax({
                    type: "POST",
                    //url: " ",
                    data: toggleState,
                    dataType: "json",

                    success: function (response) {
                        console.log('Success -------');
                    },
                    error: function () {
                        console.log('Error -------');
                    }

                });
                $('#long').text(long);
                $('#lat').text(lat);
                // }
            }, 2000);
        });

    </script>
    @include('utilities.modalscript')
@stop