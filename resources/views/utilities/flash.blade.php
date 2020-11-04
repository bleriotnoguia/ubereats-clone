@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i>Success !</h4>
        {{Session::get('success')}}
    </div>
@elseif(Session::has('danger'))
<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation-triangle"></i>Alert !</h4>
        {{Session::get('danger')}}
    </div>
@endif