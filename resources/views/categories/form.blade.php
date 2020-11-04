<?php
if ($category->id) {
    $options = ['method' => 'put', 'url' => action('CategoryController@update', $category)];
} else {
    $options = ['method' => 'post', 'url' => action('CategoryController@store')];
}
?>

@section('breadcrumbs')
{{ Breadcrumbs::render('categories.form') }}
@stop

@include('utilities.errors')
@include('utilities.flash')
{!! Form::model($category, $options) !!}
<div class="form-group">
    {!! Form::label('name', 'Nom') !!}
    {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
</div>
@if(!Auth::user()->restaurant->is_merchant)
    <div class="form-group">
        {!! Form::label('type', 'Selectionner un type') !!}
        {!! Form::select('type', array_map("__", ['items' => 'items', 'supplements' => 'supplements' ]), null , ['class' => 'form-control type-select']) !!}
    </div>
@else
    {!! Form::hidden('type', 'items') !!}
@endif
@if(!$category->id && isset($restaurant_selected))
    {!! Form::hidden('restaurant_id', $restaurant_selected->id) !!}
@endif
{!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 