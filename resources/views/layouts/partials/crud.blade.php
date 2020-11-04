@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/dropzone.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel='stylesheet' href='https://unpkg.com/croppie/croppie.css'>
    <style>
        #cropper {
            background: #eee;
            border: 4px solid #3c8dbc;
        }

        img {
            max-width: 100%;
        }
    </style>
@stop

@section('title_header', 'Formulaire')
@section('sub_title_header', 'Création ou modification d\'un élément')

@section('main')
    <div style="padding-left: 20px; padding-right: 20px;">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 crudform">
                @yield('crudform')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminlte/plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset('adminlte/plugins/dynamicForm/dynamic-form.js') }}"></script> --}}
    <script src="{{ asset('adminlte/plugins/multiInput/jq.multiinput.js') }}"></script>
    <script src="https://unpkg.com/croppie@2.6.4/croppie.js"></script>
    <script>
        $(document).ready(function () {

            $('input[name=roles]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="permission[]"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="criteria[]"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="roles[]"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="notable"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="is_merchant"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="is_merchant"]').on('ifClicked', function(event){
                if($(this).val() == 0){
                    $('.resto-input').css('display', 'block');
                }else{
                    $('.resto-input').css('display', 'none');
                }
            });

            $('input[name="obligatory_categories[]"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="is_available"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            $('input[name="is_supplement"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false,
                showMeridian: false,
                defaultTime: 'current'
            });

            $('.user-multiple').select2();
            $('.cuisine-multiple').select2({
                placeholder: 'Selectionner une ou plusieurs cuisines',
                allowClear: true
            });
            $('.cuisine-select').select2({
                placeholder: 'Selectionner une cuisine',
                allowClear: true
            });
            $('.supplements-multiple').select2({
                width: '100%'
            });
            $('.category-select').select2({
                placeholder: 'Selectionner une categorie',
                allowClear: true
            });
            $('.restaurant-select').select2({
                placeholder: 'Selectionner un restaurant',
                allowClear: true
            });

            $('.admin-shop-select').select2({
                placeholder: 'Selectionner une boutique',
                allowClear: true
            });

            $('.type-select').select2({
                placeholder: 'Selectionner ...',
                allowClear: true
            });

            $('.like').select2({
                allowClear: true
            });

        });
    </script>
@stop