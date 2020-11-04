@extends('layouts.app')

@section('css')
    @include('utilities.css-dataTables')
@endsection

@section('title', __('Items list'))

@section('title_header', 'Articles')
@section('sub_title_header', 'Liste des articles')

@section('breadcrumbs')
    {{ Breadcrumbs::render('items') }}
@stop

@section('main')

    @php
        $models = $items;
        // Numéro dans la table
        $i = 0;
     if(isset(Auth::user()->restaurant) && !Auth::user()->restaurant->is_merchant):
         $toDisplay = [
            'name' => 'Nom',
            'menu' => 'Menu',
            'category' => 'Categorie',
            // 'cuisine' => 'Cuisine',
            'price' => 'prix',
            'description' => 'Description',
            'created_at' => 'Date d\'enregistrement',
            'updated_at' => 'Date de modification'
        ];
     else:
       $toDisplay = [
            'name' => 'Nom',
            'category' => 'Categorie',
            'price' => 'prix',
            'description' => 'Description',
            'created_at' => 'Date d\'enregistrement',
            'updated_at' => 'Date de modification'
        ];
     endif;


    @endphp

    @component('utilities.modalhtml')
        @slot('title')
            Détails de l'article
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
            <a href="{{ route('items.create', isset($_restaurant) ? $_restaurant->id : '') }}" class="btn btn-primary"
               title="Ajouter un article"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
        </p>
    @endisset
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tous les articles</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                <tr role="row">
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Categorie</th>
                    @if(isset(Auth::user()->restaurant) && !Auth::user()->restaurant->is_merchant)
                        {{-- <th>Cuisine</th> --}}
                        <th>Menu</th>
                    @endif
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{isset($item->category) ? $item->category->name : ''}}</td>
                        @if(isset(Auth::user()->restaurant) && !Auth::user()->restaurant->is_merchant)
                            {{-- <td>{{isset($item->cuisine) ? $item->cuisine->name : ''}}</td> --}}
                            <td>{{isset($item->menu) ? __($item->menu->name) : ''}}</td>
                        @endif
                        <td>{{ str_limit($item->description, 35, '...')  }}
                            @if(strlen($item->description) > 35)
                                <a href="#" data-container="body" data-toggle="popover" data-placement="top"
                                   data-content="{{ $item->description }}">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            @endif
                        </td>
                        <td>{{$formatter->formatCurrency($item->price, env('CURRENCY_CODE'))}}</td>
                        <td>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-primary" title="Editer"><i
                                        class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-info" onclick="showModal({{ $item->id }})" title="Details"><i
                                        class="fa fa-info-circle"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['items.destroy', $item->id]]) !!}
                            <button type="button"
                                    onclick='allow("Confirmez vous la suppresion de ce repas ?", this, true)'
                                    class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Disponible / Indisponible">
                                <input type="checkbox" class="js-switch"
                                       {{ $item->is_available ? 'checked' : '' }} data-item-id={{$item->id}} />
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
                    @if(isset(Auth::user()->restaurant) && !Auth::user()->restaurant->is_merchant)
                        {{-- <th>Cuisine</th> --}}
                        <th>Menu</th>
                    @endif
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
    @include('utilities.modalscript')
    @include('utilities.js-dataTables')
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

        function setItemAvailabilityCallback(elem) {
            var toggleState = {
                _token: CSRF_TOKEN,
                item_id: elem.data('item-id'),
                is_available: elem.get(0).checked ? 'on' : 'off'
            };
            var _this = elem;
            $.ajax({
                type: "POST",
                url: "{{ route('items.availability') }}",
                data: toggleState,
                dataType: "json",

                success: function (response) {
                    if (response.data.is_available) {
                        $.toast({
                            heading: 'Success',
                            text: response.message + "\n L'article ( " + response.data.name + " ) est maintenant diponible",
                            icon: 'success',
                            hideAfter: 6000,
                            showHideTransition: 'slide',
                            position: "bottom-right",
                        });
                    } else {
                        $.toast({
                            heading: 'Information',
                            text: response.message + "\n L'article ( " + response.data.name + " ) est maintenant indiponible",
                            icon: 'info',
                            hideAfter: 6000,
                            showHideTransition: 'slide',
                            position: "bottom-right",
                        });
                    }

                },
                error: function (response) {
                    var if_message_exist = typeof(response.responseJSON) != 'undefined' && typeof(response.responseJSON.message) != 'undefined';
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
                                setItemAvailabilityCallback($(this))
                                })
                        },
                    });
                }

            });
        }

        $(elems).on("change", function (){
            setItemAvailabilityCallback($(this));
        });

    </script>
@endsection