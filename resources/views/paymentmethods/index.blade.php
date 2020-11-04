@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Payment methods list'))

@section('title_header', 'Methodes de paiement')
@section('sub_title_header', 'Gestion des methodes de paiement')

@section('breadcrumbs')
    {{ Breadcrumbs::render('payment_methods') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les methodes de paiement</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Activer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment_methods as $payment_method)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{__($payment_method->name)}}</td>
                        <td>{{ $payment_method->code }}</td>
                        <td>{{ str_limit($payment_method->description, 30, '...')  }} 
                            @if(strlen($payment_method->description) > 30)
                                <a href="#" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ $payment_method->description }}">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            @endif
                        </td>
                        <td>{{ $payment_method->isActive() }}</td>
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="Activer / Desactiver">
                                <input type="checkbox" class="js-switch" {{ $payment_method->active ? 'checked' : '' }} data-payment_method-id={{$payment_method->id}} />
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Activer</th>
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
    
        $(document).ready(
            function (){
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

                elems.forEach(function(html) {
                var switchery = new Switchery(html, { size: 'small' });
                });
                
                var active_text;

                function setPaymentMethodStatusCallback(elem) {
                    var toggleState = {
                        _token: CSRF_TOKEN, 
                        payment_method_id : elem.data('payment_method-id'), 
                        active : elem.get(0).checked ? 'on' : 'off' 
                        };
                    var _this = elem;
                    $.ajax({
                            type:"POST",
                            url: "{{ route('payment_methods.activation') }}",
                            data: toggleState,
                            dataType:"json",

                            success:function(response){
                                if(response.data.active){
                                    $.toast({
                                        heading: 'Success',
                                        text: response.message+"\n Ce mode de paiement a été activé",
                                        icon: 'success',
                                        hideAfter: 6000,
                                        showHideTransition: 'slide',
                                        position: "bottom-right",
                                    });
                                    _this.parent().parent().prev().text(__('Yes'));
                                }else{
                                    $.toast({
                                        heading: 'Information',
                                        text: response.message+"\n Ce mode de paiement a été desactivé",
                                        icon: 'info',
                                        hideAfter: 6000,
                                        showHideTransition: 'slide',
                                        position: "bottom-right",
                                    });
                                    _this.parent().parent().prev().text(__('No'));
                                }
                                
                            },
                            error:function(response){
                                var if_message_exist = typeof(response.responseJSON) != 'undefined' && typeof(response.responseJSON.message) != 'undefined';
                                swal({
                                    title: 'Erreur !',
                                    text: if_message_exist ? response.responseJSON.message : 'Echec de mise à jour. \n C\'est peut etre un problème de connexion.',
                                    icon: 'warning'
                                }).then(function(){
                                    _this.off('change');
                                    _this.trigger('click');
                                    _this.on('change', function(){
                                        setPaymentMethodStatusCallback($(this))
                                        })
                                });
                            }
                        });
                }

                $(elems).on("change" , function (){
                    setPaymentMethodStatusCallback($(this));
                });

            }
        );

    </script>
@stop 