@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Shops list'))

@section('title_header', 'Boutiques')
@section('sub_title_header', 'Liste des boutiques')
@section('breadcrumbs')
    {{ Breadcrumbs::render('restaurants') }}
@stop
@section('main')

@php
$models = $restaurants;
// dd($models);
// Numéro dans la table
$i = 0;
$toDisplay = [ 
    'name' => 'Nom',
    'description' => 'Présentation de la boutique',
    'email' => 'Email',
    'phone_number' => 'Numéro de télephone',
    'cuisines' => 'Cuisine(s)',
    'deliveries_time' => 'Temps de livraison',
    'preparation_time' => 'Temps de préparation',
    'location' => 'Emplacement',
    'country_name' => 'Pays',
    'city_name' => 'Ville',
    'address_description' => 'Description de l\'adresse',
    'created_at' => 'Date d\'enregistrement',
    'updated_at' => 'Date de modification'
 ];
@endphp

@component('utilities.modalhtml')
    @slot('title')
        Détails de la boutique
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent

@include('utilities.flash')
@if(Auth::user()->isSuperAdmin())
    <p class="text-left">
        <a href="{{route('restaurants.create')}}" id="btn-resto" title="Add restaurant" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
    </p>
@endif
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Toutes les boutiques</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Numéro de télephone</th>
                        <th>Date d'enregistrement</th>
                        <th>Administrateur</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$restaurant->name}}</td>
                        <td>{{$restaurant->type}}</td>
                        <td>{{$restaurant->email}}</td>
                        <td>{{$restaurant->phone_number}}</td>
                        <td>{{$restaurant->created_at->format('d/m/Y H:i')}}</td>
                        <td>{{$restaurant->user->full_name}}</td>
                        <td>
                        @if($restaurant->user->isOnline())
                            <i class="fa fa-circle text-success" style="font-size: 8px"></i>
                            <span class="text-success">{{ __('online') }}</span>
                        @else
                            <i class="fa fa-circle text-default" style="font-size: 8px"></i>
                            <span class="text-default">{{ __('offline') }}</span>
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $restaurant->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                            <a href="{{ route('restaurants.items_index', $restaurant) }}" class="btn btn-primary" title="Liste des articles"><i class="fa fa-coffee"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['restaurants.destroy', $restaurant->id]]) !!}
                            <button type="button" onclick='allow("Confirmez vous la suppresion de ce restaurant ? \n Tous les menus, categories et articles de ce restaurant seront supprimés", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Activer / Desactiver">
                                <input type="checkbox" class="js-switch" {{ $restaurant->active ? 'checked' : '' }} data-restaurant-id={{$restaurant->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Numéro de télephone</th>
                        <th>Date d'enregistrement</th>
                        <th>Administrateur</th>
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
    <script>
        
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
        var switchery = new Switchery(html, { size: 'small' });
        });

        function setShopStatusCallback(elem) {
            var toggleState = {
                _token: CSRF_TOKEN, 
                restaurant_id : elem.data('restaurant-id'), 
                active : elem.get(0).checked ? 'on' : 'off' 
                };
            var _this = elem;
            $.ajax({
                    type:"POST",
                    url: "{{ route('restaurants.activation') }}",
                    data: toggleState,
                    dataType:"json",

                    success:function(response){
                        if(response.data.active){
                            $.toast({
                                heading: 'Success',
                                text: response.message+"\n Le restaurant ( "+response.data.name+" ) est maintenant diponible",
                                icon: 'success',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                            });
                        }else{
                            $.toast({
                                heading: 'Information',
                                text: response.message+"\n Le restaurant ( "+response.data.name+" ) est maintenant indiponible",
                                icon: 'info',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                            });
                        }
                        
                    },
                    error:function(response){
                        if_message_exist = typeof(response.responseJSON) != 'undefined' && typeof(response.responseJSON.message) != 'undefined';
                        $.toast({
                                heading: 'Erreur',
                                text: if_message_exist ? response.responseJSON.message : 'Echec de mise à jour. \n C\'est peut etre un problème de connexion.',
                                icon: 'error',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                                afterShown: function () {
                                    _this.off('change');
                                    _this.trigger('click');
                                    _this.on('change', function(){
                                        setShopStatusCallback($(this))
                                        })
                                },
                            });
                        }
                });
        }

        $(elems).on("change" , function (){
            setShopStatusCallback($(this));
        });
    </script>
    @include('utilities.modalscript')
@stop