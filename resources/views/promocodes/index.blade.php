@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', 'Promocodes')

@section('title_header', 'Promocodes')
@section('sub_title_header', 'Gestion des promocodes')

@section('breadcrumbs')
    {{ Breadcrumbs::render('promocodes') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
    if(!Auth::user()->isSuperAdmin()){
        if(isset($_restaurant)){
            $promocodes = $_restaurant->promocodes;
        }else{
            $promocodes = collect([]);
        }
    }
    $models = $promocodes;
    $toDisplay = [
        'code' => 'Coupon code',
        'coupon_type' => 'Type de coupon code',
        'discount_type' => 'Type de réduction',
        'expires_at' => 'Date d\'expiration',
        'validity_date' => 'Date de validité',
        'coupon_description' => 'Description'
    ];
@endphp

@component('promocodes.modalhtml')
    @slot('title')
        Détails du code coupon
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent
@include('utilities.flash')
<div class="text-left" style="margin-bottom: 15px">
    @if(Auth::user()->isSuperAdmin())
        {!! Form::open(['method' => 'GET', 'style' => "display: inline-block", 'route' => ['notations.index'], 'id' => 'filterForm']) !!}
            {!! Form::select('restaurant_id', array(" " => __('All') ) + App\Models\Restaurant::pluck('name', 'id')->toArray(), isset(\Request::query()['restaurant_id']) ? \Request::query()['restaurant_id'] : null , ['class' => 'form-control restaurant-select']) !!}
        {!! Form::close() !!}

        {!! Form::open(['method' => 'post', 'style' => "display: inline", 'route' => ['clear.redundant']]) !!}
        <button type="button" title="Nettoyer la liste" onclick='allow("Voulez vous supprimés les code coupons redondants et/ou expirés ?", this)' class="btn btn-danger"><i class="fa fa-trash"></i> Nettoyer la liste</button>
        {!! Form::close() !!}
    @else
        <a href="{{route('promocodes.create')}}" class="btn btn-primary" title="Ajouter un code coupon"><i class="fa fa-plus-circle"></i> Ajouter</a>
    @endif
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les promocodes</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Date d'expiration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promocodes as $promocode)
                        @if($promocode->restaurant)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$promocode->code}}</td>
                                <td>{{ isset($promocode->data->coupon_description) ? $promocode->data->coupon_description : '' }}</td>
                                <td>{{ isset($promocode->data->start_at) ? $promocode->data->start_at : '' }}</td>
                                <td>{{ isset($promocode->expires_at) ? $promocode->expires_at->format('d/m/Y à H:i:s') : '' }}</td>
                                <td>{!! $promocode->state !!}</td>
                                <td>
                                    <a href="#" class="btn btn-info" onclick="showModal({{ $promocode->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                                    <a href="{{ route('promocodes.edit', $promocode) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                                    {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['promocodes.destroy', $promocode->id]]) !!}
                                    <button type="button" onclick='allow("Confirmez vous la suppresion de ce promocode ?", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Date d'expiration</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@stop()
@section('scripts')
@include('utilities.js-dataTables')
<script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        var modelsList = @json($models->all());

        function formatDate(date){
            let tanggal = moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
            return tanggal;
        }

        function showModal(id){
            var modelDetails = modelsList.find(
                function checkModel(item){
                    return item.id == id;
                }
            );
            // Decorer modelmodal avec les valeurs du model
            for(var key in modelDetails){
                if(document.querySelector(`#promoModal .${key}`)){
                    if(key == 'expires_at'){
                        modelDetails[key] = formatDate(modelDetails[key]);
                    }
                    document.querySelector(`#promoModal .${key}`).innerHTML = modelDetails[key];
                }
            };

            for(var key in modelDetails.data){
                if(document.querySelector(`#promoModal .${key}`)){
                    document.querySelector(`#promoModal .${key}`).innerHTML = __(modelDetails.data[key]);
                }
                if(key == 'discount_type'){
                    if($('#promoModal .discount-percent') || $('#promoModal .discount-amount')){
                        $('#promoModal .discount-percent').parent().remove();
                        $('#promoModal .discount-amount').parent().remove();
                    }
                    if(modelDetails.data[key] == 'amount'){
                        $(`#promoModal .${key}`).parent().after('<tr><th>Montant de réduction</th><td class="discount-amount">'+ modelDetails.data['discount_amount'] +'</td></tr>');
                    }else if(modelDetails.data[key] == 'percent'){
                        $(`#promoModal .${key}`).parent().after('<tr><th>Pourcentage de réduction</th><td class="discount-percent">'+ modelDetails.data['discount_percent'] +'</td></tr>');
                    }
                }
            };

            $('#promoModal').modal('toggle');
        }

        $(document).ready(function(){
            $('.restaurant-select').select2();
            $('.restaurant-select').change(
                function (){
                    $('#filterForm').attr('action', '{{ route('promocodes.index') }}');
                    $('#filterForm').submit();
                }
            );
        });
    </script>
@stop 