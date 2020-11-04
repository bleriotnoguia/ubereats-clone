<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.htmlheader')

<!-- BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------| -->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

@if(Auth::check())
      <!-- Main Header -->
      @include('layouts.partials.mainheader')

    <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.partials.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    {{-- @include('layouts.partials.contentheader') --}}
    <section class="content-header">
        <h1>
            @yield('title_header', 'Tableau de bord') 
            <small>@yield('sub_title_header', 'Panneau de contrôle')</small>
        </h1>
        @section('breadcrumbs')
          {{ Breadcrumbs::render('home') }}
        @show
    </section>
    <!-- Main content -->
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="preloader">
        <div class="lds-spinner">
          <div></div><div></div>
          <div></div><div></div>
          <div></div><div></div>
          <div></div><div></div>
          <div></div><div></div>
          <div></div><div></div>
        </div>
      </div>
      @if (auth()->user()->onboarding()->inProgress())
        <div class="alert alert-warning">
              <ol>
              @foreach (auth()->user()->onboarding()->steps as $step)
              <li {!! $step->complete() ? 'style="text-decoration: line-through; font-style: italic"' : '' !!}>
                          <i class="{!! $step->complete() ? 'fa fa-check-square-o fa-fw' : 'fa fa-square-o fa-fw' !!}"></i>
                          <b>{{ $step->title }}</b>
                          @if(!$step->complete())
                              <a href="{{ $step->link }}">
                                  {{ $step->cta }}
                              </a>
                          @endif
                      </li>
                  @endforeach
              </ol>
        </div>
      @endif
      @yield('main')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')

  <!-- Control Sidebar -->
  @include('layouts.partials.controlsidebar')
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@else
<div class="content-wrapper" style="margin-left: 0px">
  <!-- Main content -->
  <section class="content container-fluid">
      <!--------------------------
      | Your Page Content Here 2 |
      -------------------------->
    @yield('main')
  </section>
</div>
@endif

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
{{-- <script src="{{ asset('adminlte/plugins/jquery/dist/jquery.min.js') }}"></script> --}}
{{-- <script src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<!-- Slimscroll -->
<script src="{{ asset('adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> --}}
{{-- FastClick --}}
<script src="{{asset('adminlte/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/translate/jquery.translate.js') }}"></script>
<script src="{{ asset('adminlte/plugins/switchery/switchery.min.js') }}"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="{{ asset('adminlte/plugins/lazyload/lazyload.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom.js') }}"></script>
{{-- <script src="{{ asset('js/chart-demo.js') }}"></script> --}}
{{-- <script src="//js.pusher.com/3.1/pusher.min.js"></script> --}}
{{-- <script src="{{ asset('js/notification.js') }}"></script> --}}
@yield('scripts')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<!-- Scripts -->
<script>

window.laravel = @json(['csrfToken' => csrf_token()]);
@if(!auth()->guest())
  // This makes the current user's id available in javascript
  window.laravel.userId = {{ auth()->user()->id }};

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
  @if(!auth()->user()->isSuperAdmin())

    var elem = document.querySelector('.open-js-switch');
    var init = new Switchery(elem, {size: 'small'});

    var is_open_text = document.createElement("div");
    var is_close_text = document.createElement("div");

    is_open_text.innerHTML = "<p>Votre boutique est actuellement ouverte !<\p>"+
                            "<p><i class='fa fa-info-circle text-primary'></i> <small>Notez que votre boutique ne peut pas etre consideré comme ouverte pendant vos horaires de fermeture.<small></p>";
    is_close_text.innerHTML = "<p>Votre boutique est actuellement fermée !<\p>"+
                            "<p><i class='fa fa-info-circle text-primary'></i> <small>Notez que, dans ce cas votre boutique reste fermée même pendant vos horaires d\'ouverture.<small></p>";

    function setShopAvailabilityCallback(elem) {
        var toggleState = {
            _token: CSRF_TOKEN,
            restaurant_id: elem.data('restaurant-id'),
            is_open: elem.get(0).checked ? 'on' : 'off'
        };
        var _this = elem;
        $.ajax({
            type: "POST",
            url: "{{ route('shop.availability') }}",
            data: toggleState,
            dataType: "json",

            success: function (response) {
                if (response.data.is_open) {
                  swal({
                        title: 'Ouverte !',
                        content: is_open_text,
                        icon: 'success'
                    });
                } else {
                  swal({
                        title: 'Fermée !',
                        content: is_close_text,
                        icon: 'success'
                    });
                }
            },
            error: function (response) {
              var if_message_exist = typeof(response.responseJSON) != 'undefined' && typeof(response.responseJSON.message) != 'undefined';
              swal({
                    title: 'Erreur !',
                    text:  if_message_exist ? response.responseJSON.message : 'Echec de mise à jour. \n C\'est peut etre un problème de connexion.',
                    icon: 'warning'
                }).then(function(){
                    _this.off('change');
                    _this.trigger('click');
                    _this.on('change', function(){
                      setShopAvailabilityCallback($(this))
                        })
                });
            }

        });
    }

    $(elem).on("change", function(){
      setShopAvailabilityCallback($(this))
    });

  @endif
  
@endif

</script>

</body>
</html>