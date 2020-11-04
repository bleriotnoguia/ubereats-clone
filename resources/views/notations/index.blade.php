@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
@endsection

@section('title', __('Notations list'))

@section('title_header', 'Notations')
@section('sub_title_header', 'Liste des notations')

@section('breadcrumbs')
    {{ Breadcrumbs::render('notations') }}
@stop

@section('main')
@php
$models = $notations->pluck('user');
$i = 0;
$j = 1;
$userDataToDisplay = [ 
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
        Informations sur l'utilisateur
    @endslot
    @foreach ($userDataToDisplay as $key => $value)
        <tr>
            <th>{{ $value }}</th>
            <td class="{{ $key }}">default text</td>
        </tr>
    @endforeach
@endcomponent
@include('utilities.flash')
<p class="text-left">
        {!! Form::open(['method' => 'GET', 'style' => "display: inline-block", 'route' => ['notations.index'], 'id' => 'filterForm']) !!}
            {!! Form::select('restaurant_id', array(" " => __('All') ) + App\Models\Restaurant::pluck('name', 'id')->toArray(), isset(\Request::query()['restaurant_id']) ? \Request::query()['restaurant_id'] : null , ['class' => 'form-control restaurant-select']) !!}
        {!! Form::close() !!}
        <a href="#" class="btn btn-primary btn-add-notation">Ajouter une notation</a>
    {{-- <a href="{{route('notations.create')}}" class="btn btn-primary">Ajouter une notation</a> --}}
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Toutes les notations</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Commande</th>
                        <th>Utilisateur</th>
                        <th>Commentaire</th>
                        <th>Etoiles</th>
                        <th>Avis</th>
                        <th>type</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notations as $notation)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>
                            <a href="{{ route('orders.show', $notation->order) }}" class="text-bold">{{$notation->order->number}}</a>  
                        </td>
                        <td>{{ $notation->user->full_name }}<a href="#" onclick="showModal({{ isset($notation->user) ? $notation->user_id : '' }})"> <i class="fa fa-plus-circle"></i></a></td>
                        <td>{{ str_limit($notation->comment, 30, '...')  }} 
                            @if(strlen($notation->comment) > 30)
                                <a href="#" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ $notation->comment }}">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @for ($k = 1; $k <= 5; $k++)
                                @while ($j <= $notation->star)
                                    <i class="fa fa-star text-yellow"></i>
                                    @php $j++ ; $k++; @endphp
                                @endwhile
                                @if($notation->star < 5)
                                    <i class="fa fa-star text-gray"></i> 
                                @endif   
                            @endfor 
                            @php
                                $j = 1;   
                            @endphp   
                        </td>
                        <td>
                            @if($notation->like)
                                <i class="fa fa-thumbs-up text-success"></i>
                            @else
                                <i class="fa fa-thumbs-down text-danger"></i>
                            @endif
                        </td>
                        <td>{{ __( class_basename($notation->notable_type) ) }}</td>
                        <td>{{ \Carbon\Carbon::parse($notation->created_at)->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('notations.edit', $notation) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['notations.destroy', $notation->id]]) !!}
                            <button type="button" title="Supprimer" onclick='allow("Confirmez vous la suppresion de cette notation ?", this, true)' class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                            <span data-toggle="tooltip" data-placement="top" title="Publié / Non Publié">
                                <input type="checkbox" class="js-switch" {{ $notation->is_published ? 'checked' : '' }} data-notation-id={{$notation->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Commande</th>
                        <th>Utilisateur</th>
                        <th>Commentaire</th>
                        <th>Etoiles</th>
                        <th>Avis</th>
                        <th>type</th>
                        <th>Date</th>
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
    @include('utilities.modalscript')
    <script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
    <script>
    
            $('.restaurant-select').select2();
            $('.restaurant-select').change(
                function (){
                    $('#filterForm').attr('action', '{{ route('notations.index') }}');
                    $('#filterForm').submit();
                }
            );
            
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

            elems.forEach(function(html) {
            var switchery = new Switchery(html, { size: 'small' });
            });

            function setNotationStatusCallback(elem) {
                var toggleState = {
                    _token: CSRF_TOKEN, 
                    notation_id : elem.data('notation-id'), 
                    is_published : elem.get(0).checked ? 'on' : 'off' 
                    };
                var _this = elem;
                $.ajax({
                        type:"POST",
                        url: "{{ route('notations.published') }}",
                        data: toggleState,
                        dataType:"json",

                        success:function(response){
                            if(response.data.is_published){
                                $.toast({
                                    heading: 'Success',
                                    text: response.message+"\n Cette notation a été rendu public",
                                    icon: 'success',
                                    hideAfter: 6000,
                                    showHideTransition: 'slide',
                                    position: "bottom-right",
                                });
                            }else{
                                $.toast({
                                    heading: 'Information',
                                    text: response.message+"\n Cette notation a été masquée",
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
                                text: if_message_exist ? response.responseJSON.message : 'Echec de mise à jour. C\'est peut etre un problème de connexion.',
                                icon: 'error',
                                hideAfter: 6000,
                                showHideTransition: 'slide',
                                position: "bottom-right",
                                afterShown: function () {
                                    _this.off('change');
                                    _this.trigger('click');
                                    _this.on('change', function(){
                                        setNotationStatusCallback($(this))
                                        })
                                }
                            });
                        }
                });
            }
            
            $(elems).on("change" , function(){
                setNotationStatusCallback($(this))
            });

    </script>
@stop 