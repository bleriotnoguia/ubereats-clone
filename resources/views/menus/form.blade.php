<?php
    if($menu->id){
        $options = ['method' => 'put', 'url'=>action('MenuController@update', $menu)];
    }else {
        $options = ['method' => 'post', 'url'=>action('MenuController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('menus.form') }}
@stop

{!! Form::model($menu, $options) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        @if(!$menu->id && isset($restaurant_selected))
        {!! Form::hidden('restaurant_id', $restaurant_selected->id) !!}
        @endif
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 