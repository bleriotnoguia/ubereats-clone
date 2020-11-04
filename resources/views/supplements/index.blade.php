@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Supplements list'))

@section('title_header', 'Suppléments')
@section('sub_title_header', 'Liste des suppléments')

@section('breadcrumbs')
    {{ Breadcrumbs::render('supplements') }}
@stop

@section('main')

@php
$models = $supplements;
// Numéro dans la table
$i = 0;
$toDisplay = [
    'name' => 'Nom',
    'category' => 'Categorie',
    'price' => 'prix',
    'description' => 'Description', 
    'created_at' => 'Date d\'enregistrement', 
    'updated_at' => 'Date de modification'
];
@endphp

@component('utilities.modalhtml')
    @slot('title')
        Détails du supplément
    @endslot
    @foreach ($toDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}"></td>
        </tr>
    @endforeach
@endcomponent
@include('utilities.flash')
@isset($_restaurant)
<p class="text-left">
    <a href="{{ route('supplements.create', $_restaurant->id) }}" class="btn btn-primary" title="Ajouter un suppléments"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
</p>
@endisset
<div class="box">
    <div class="box-header">
    <h3 class="box-title">Tous les suppléments </strong></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplements as $supplement)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$supplement->name}}</td>
                        <td>{{isset($supplement->category) ? $supplement->category->name : ''}}</td>
                        <td>{{ str_limit($supplement->description, 35, '...')  }} 
                        @if(strlen($supplement->description) > 35)
                            <a href="#" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ $supplement->description }}">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        @endif
                        </td>
                        <td>{{$formatter->formatCurrency($supplement->price, env('CURRENCY_CODE'))}}</td>
                        <td>
                            <a href="{{ route('supplements.edit', $supplement) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $supplement->id }})" title="Details"><i class="fa fa-info-circle"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['supplements.destroy', $supplement->id]]) !!}
                            <button type="button" onclick='allow("Confirmez vous la suppresion de ce repas ?", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Disponible / Indisponible">
                                <input type="checkbox" class="js-switch" {{ $supplement->is_available ? 'checked' : '' }} data-supplement-id={{$supplement->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Categorie</th>
                        <th>Description</th>
                        <th>Prix</th>
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
    @include('utilities.modalscript')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
            $('.btn').tooltip();
        })
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function(html) {
        var switchery = new Switchery(html, { size: 'small' });
        });

        $(elems).on("change" , function() {
            var toggleState = {
                _token: CSRF_TOKEN, 
                supplement_id : $(this).data('supplement-id'), 
                is_available : $(this).get(0).checked ? 'on' : 'off' 
                };
            var _this = $(this);
            $.ajax({
                    type:"POST",
                    url: "{{ route('supplements.availability') }}",
                    data: toggleState,
                    dataType:"json",

                    success:function(response){
                        if(response.data.is_available){
                            $.toast({
                                heading: 'Success',
                                text: response.message+"\n L'article ( "+response.data.name+" ) est maintenant diponible",
                                icon: 'success',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                            });
                        }else{
                            $.toast({
                                heading: 'Information',
                                text: response.message+"\n L'article ( "+response.data.name+" ) est maintenant indiponible",
                                icon: 'info',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                            });
                        }
                        
                    },
                    error:function(){
                        $.toast({
                                heading: 'Erreur',
                                text: 'Echec de mise à jour. \n C\'est peut etre un problème de connexion.',
                                icon: 'error',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                            });
                        // _this.toggle(_this.get(0).checked);;
                        // console.log(_this.get(0));
                    }

                });
        });
    </script>
@endsection