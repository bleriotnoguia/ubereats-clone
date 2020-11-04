@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-exclamation-triangle"></i><strong>Oops !</strong> {{ __('An error has occurred') }}</h4>
    {{-- <ul>
        <li>{{ __('Check if you have filled all the fields') }}</li>
    </ul> --}}
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif