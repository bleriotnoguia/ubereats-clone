<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        {{__('Code by')}} <a href="https://bleriotnoguia.com/" target="blank">Bleriot Noguia</a>
    </div>
    <!-- Default to the left -->
<strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>.</strong> {{__('All rights reserved')}}. <a href="{{route('site.terms')}}">{{ __('Terms of use') }}</a> | <a href="{{route('site.privacy')}}">{{ __('Privacy policy') }}</a>
</footer>