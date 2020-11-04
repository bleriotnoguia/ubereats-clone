<?php
    if($cuisine->id){
        $options = ['method' => 'put', 'url'=>action('CuisineController@update', $cuisine)];
    }else {
        $options = ['method' => 'post', 'url'=>action('CuisineController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuisines.form') }}
@stop

{!! Form::model($cuisine, $options) !!}
        <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 