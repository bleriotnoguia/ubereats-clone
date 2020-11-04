@extends('layouts.app')

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('title', __('Orders list'))

@section('title_header', 'Commandes')
@section('sub_title_header', 'Liste des commandes')
@section('breadcrumbs')
    @if(isset($customer))
        {{ Breadcrumbs::render('customers.orders') }}
    @else
        {{ Breadcrumbs::render('orders') }}
    @endif
@stop
@section('main')

@php
if(isset($customer)){
    $builder = $customer->orders()->with(['restaurant','user', 'orderLines', 'orderLines.model', 'shipping', 'shipping.address']);
    if(isset($_restaurant)){
        $orders = $builder->where('restaurant_id', $_restaurant->id)->get();
    }else if(Auth::user()->isSuperAdmin()){
        $orders = $builder->get();
    }
}
$models = $orders;
$i = 0;
$toDisplay = [
    'restaurant_name' => 'Nom du restaurant',
    'number' => 'Numéro de la commande',
    'user_full_name' => 'Nom du client',
    'user_email' => 'Email du client',
    'user_location' => 'Adresse du client',
    'user_phone_number' => 'Numéro de télephone',
    'total' => 'Total',
    'shipping_fee' => 'Frais de livraison',
    'reduction' => 'Réduction',
    'total_to_pay' => 'Total à payer',
    'created_at' => 'Date de création',
    'updated_at' => 'Date de modification',
    'status' => 'Statut',
    'comment' => 'Commentaire'
];
@endphp

@component('orders.modalhtml')
    @slot('title')
        Détails de la commande
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent
@include('orders.inputmodalcancel')
@include('utilities.errors')
@include('utilities.flash')
@if (!isset($customer))
    {!! Form::open(['method' => 'GET', 'style' => "display: inline-block; padding-bottom: 10px", 'id' => 'filterForm']) !!}
    @hasrole('super-admin')
        {!! Form::select('restaurant_id', array(" " => __('All') ) + App\Models\Restaurant::pluck('name', 'id')->toArray(), isset(\Request::query()['restaurant_id']) ? \Request::query()['restaurant_id'] : null , ['class' => 'form-control restaurant-select']) !!}
    @endhasrole
    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
        <span>{{ isset(\Request::query()['from']) && isset(\Request::query()['to']) ? \Carbon\Carbon::createFromFormat('Y-m-d', \Request::query()['from'])->isoFormat('MMMM D, YYYY').'-'.\Carbon\Carbon::createFromFormat('Y-m-d', \Request::query()['to'])->isoFormat('MMMM D, YYYY') : 'Selectionner une période' }}</span>
        <i class="fa fa-caret-down"></i>
    </button>
    <input type="hidden" name="from" value="{{ isset(\Request::query()['from']) ? \Request::query()['from'] : '' }}">
    <input type="hidden" name="to" value="{{ isset(\Request::query()['to']) ? \Request::query()['to'] : '' }}">
    {!! Form::close() !!}
@endif
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{ $orders->where('status', 'shipped')->count()  }}</h3>
            <p>Commandes livrées</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3>{{ $orders->whereIn('status', ['canceled', 'canceled'])->count()  }}</h3>
            <p>Commandes échouées</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $orders->whereNotIn('status', ['canceled', 'shipped'])->count()  }}</h3>
                <p>Commandes en cours</p>
            </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $formatter->formatCurrency($orders->whereNotIn('status', ['canceled', 'pending'])->pluck('total')->sum(), env('CURRENCY_CODE')) }} </h3>
                <p>De revenus</p>
            </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Toutes les commandes {!! isset($customer) ? 'du client : <b>'.$customer->full_name.'</b>' : '' !!}</h3>
    </div>
    <div class="box-body">
        <table id="modelTable" class="table table-bordered table-striped dataTable">
            <thead>
                <tr role="row">
                    <th>N°</th>
                    @if (Auth::user()->isSuperAdmin())
                    <th>Restaurant</th>
                    @endif
                    <th>Numéro</th>
                    <th>Total à payer</th>
                    <th>Nom du client</th>
                    <th>Créer le</th>
                    <th>Prévu pour</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)

                <tr {!! isset($order->shipping->planned_at) ? 'style=background-color:#F0E68C' : '' !!}>
                <td>{{++$i}} {!! isset($order->shipping->planned_at) && (\Carbon\Carbon::now()->toDateTimeString() > $order->shipping->planned_at) ? '<i class="fa fa-exclamation-triangle text-danger"></i>' : '' !!}</td>
                    @if (Auth::user()->isSuperAdmin())
                    <td><a href="{{ route('restaurants.show', $order->restaurant) }}">{{ str_limit($order->restaurant->name, 15, '...') }}</a></td>
                    @endif    
                    <td><a href="{{ route('orders.show', $order) }}" class="text-bold">{{$order->number}}</a></td>
                    <td>{{ $formatter->formatCurrency($order->total_to_pay, env('CURRENCY_CODE')) }}</td>
                    <td>{{$order->user->full_name}}</td>
                    <td>{{$order->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{ isset($order->shipping->planned_at) ? $order->shipping->planned_at : 'Dès que possible' }}</td>
                    <td>{!! $order->status_html !!}</td>
                    <td>
                        <a href="#" class="btn btn-info" onclick="showModal({{ $order->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                        @if(Auth::user()->isSuperAdmin())
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['orders.destroy', $order->id]]) !!}
                            <button type="button" title="Supprimer" onclick='allow("Confirmez vous la suppresion de cette commande ?", this, true)' class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        @endif
                        @if($order->status=="pending")
                            {!! Form::open(['method' => 'put', 'style' => "display: inline", 'route' => ['orders.update', $order->id]]) !!}
                                {!! Form::hidden('status', 'confirmed') !!}
                            <button type="button" title="Confirmer" onclick='allow("Voulez vous prendre en charge cette commande ?", this)' class="btn btn-success"><i class="fa fa-check-square-o"></i></button>
                            {!! Form::close() !!}
                            <button type="submit" title="Annuler" class="btn btn-danger submitCancelBtn" data-order-id={{ $order->id }} data-toggle='modal' data-target='#cancelOrderModal'><i class="fa fa-times"></i></button>
                        @endif
                        <a href="{{ Route('orders.pdf', $order) }}" title="Télécharger en pdf" class="btn btn-primary"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>N°</th>
                    @if (Auth::user()->isSuperAdmin())
                    <th>Restaurant</th>
                    @endif
                    <th>Numéro</th>
                    <th>Total à payer</th>
                    <th>Nom du client</th>
                    <th>Créer le</th>
                    <th>Prévu pour</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
</div>
</div>
<!-- /.box -->

@stop()

@section('scripts')
@include('utilities.js-dataTables')
<script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/iCheck/iCheck.min.js') }}"></script>
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
<script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
var modelsList = @json($models->all());

function showModal(id){

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var modelDetails = modelsList.find(
        function checkModel(item){
            return item.id == id;
        }
    );
    // Decorer modelmodal avec les valeurs du model
    for(var key in modelDetails){

        if(key == 'user'){
            for(var user_key in modelDetails.user){
                if(document.querySelector(`#orderModal .user_${user_key}`)){
                    document.querySelector(`#orderModal .user_${user_key}`).innerHTML = modelDetails.user[user_key];
                }
            }
        }else if(key == 'restaurant'){
            for(var resto_key in modelDetails.restaurant){
                if(document.querySelector(`#orderModal .restaurant_${resto_key}`)){
                    document.querySelector(`#orderModal .restaurant_${resto_key}`).innerHTML = modelDetails.restaurant[resto_key];
                }
            }
        }else{
            if(document.querySelector(`#orderModal .${key}`)){
                if(key == 'reduction'){
                    if(modelDetails.coupon_data != undefined){
                        document.querySelector(`#orderModal .${key}`).innerHTML = formatter.format(modelDetails[key]) + ' <a href="#" data-toggle="tooltip" title="'+'Code : '+modelDetails.coupon_data.code+'\n - Type de coupon : '+__(modelDetails.coupon_data.discount_type)+'"><i class="fa fa-question-circle"></i></a>';
                    }else{
                        document.querySelector(`#orderModal .${key}`).innerHTML = 'aucun';
                    }
                }else if(key == 'total' || key == 'total_to_pay'){
                    document.querySelector(`#orderModal .${key}`).innerHTML = formatter.format(modelDetails[key]);
                }else{
                    document.querySelector(`#orderModal .${key}`).innerHTML = __(modelDetails[key]);
                }
            }
        }
    };
    if(modelDetails.shipping != null){
        document.querySelector(`#orderModal .shipping_fee`).innerHTML = formatter.format(modelDetails.shipping.fee);
    }else{
        document.querySelector(`#orderModal .shipping_fee`).innerHTML = 'aucun';
    }
    // Check if there are order_line
    // console.log(modelDetails);
    $('table.items_list').empty();
    for(var key in modelDetails){
        // On s'assure de recuperer un array pour effectuer la prochaine instruction sans bug
        if(key == 'order_lines' && typeof modelDetails[key] == "object"){
            modelDetails[key] = Object.values(modelDetails[key]);
        }
        if(key == 'order_lines' && modelDetails[key].length > 0){
            var order_lines = modelDetails[key];
            $('table.items_list').append('<tr><th>Nom</th><th>Quantité</th><th>Prix unitaire</th><th>Total</th></tr>')
            for(var line of order_lines){
                var user_comment = line.comment ? ' <a href="#" data-toggle="tooltip" title="'+__('comment')+':'+line.comment+'"><i class="fa fa-commenting"></i></a>' : '';
                $('table.items_list').append('<tr><td class="item_name" title="'+line.model.name+'">'+line.model.name.substring(0,30)+"..." + user_comment + '</td><td class="quantity">'+line.quantity+'</td><td class="item_price">'+formatter.format(line.model.price)+'</td><td class="total">'+formatter.format(line.quantity*line.model.price)+'</td></tr>');
            }
        }
    }

    $('#orderModal').modal('toggle');
}

$('.submitCancelBtn').click(function() {
     /* when the button#submitBtn is clicked, we update the action of the #cancelForm */
     var orderId = $(this).data('order-id');
     $('#cancelForm').attr('action', '{{ route('orders.index') }}'+'/'+orderId);
    //  $('.message-title').val('');
    //  $('.message-details').val('');
});

$('.submitDelayBtn').click(function() {
     /* when the button#submitBtn is clicked, we update the action of the #delayForm */
     var orderId = $(this).data('order-id');
     $('#delayForm').attr('action', '{{ route('orders.index') }}'+'/'+orderId);
    //  $('.message-title').val('');
    //  $('.message-details').val('');
});

$('#daterange-btn').daterangepicker(
    {
    opens: 'right',
    locale : {
        'format': 'MM/DD/YYYY',
        'separator': ' - ',
        'applyLabel': '{{__("Apply")}}',
        'cancelLabel': '{{__("Cancel")}}',
        'fromLabel': '{{__("From")}}',
        'toLabel': '{{__("To")}}',
        'customRangeLabel': '{{__("Custom")}}',
        'daysOfWeek': [
            '{{__("Su")}}',
            '{{__("Mo")}}',
            '{{__("Tu")}}',
            '{{__("We")}}',
            '{{__("Th")}}',
            '{{__("Fr")}}',
            '{{__("Sa")}}'
        ],
        'monthNames': [
            '{{__("January")}}',
            '{{__("February")}}',
            '{{__("March")}}',
            '{{__("April")}}',
            '{{__("May")}}',
            '{{__("June")}}',
            '{{__("July")}}',
            '{{__("August")}}',
            '{{__("September")}}',
            '{{__("October")}}',
            '{{__("November")}}',
            '{{__("December")}}'
        ],
        'firstDay': 1
    },
    ranges   : {
        '{{__("Today")}}'       : [moment(), moment()],
        '{{__("Yesterday")}}'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '{{__("Last 7 Days")}}' : [moment().subtract(6, 'days'), moment()],
        '{{__("Last 30 Days")}}': [moment().subtract(29, 'days'), moment()],
        '{{__("This Month")}}'  : [moment().startOf('month'), moment().endOf('month')],
        '{{__("Last Month")}}'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: $('input[name=from]').val() ? moment(new Date($('input[name=from]').val())).format('MM/DD/YYYY') : moment().subtract(29, 'days'),
    endDate  : $('input[name=to]').val() ? moment(new Date($('input[name=to]').val())).format('MM/DD/YYYY') : moment()
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
);
$('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
    $('input[name=from]').val(picker.startDate.format('YYYY-MM-DD'));
    $('input[name=to]').val(picker.endDate.format('YYYY-MM-DD'));
    $('#filterForm').submit();
});
$('.restaurant-select').select2();
$('.restaurant-select').change(
    function (){
        $('#filterForm').attr('action', '{{ route('orders.index') }}');
        $('#filterForm').submit();
    }
);

$('input[name=cancellation_reason]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
});

$('input[name=delay_added]').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
// console.log(getUrlParameter('from'));

</script>
@stop
