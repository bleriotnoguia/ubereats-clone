<?php
    if($supplement->id){
        $options = ['method' => 'put', 'url'=>action('SupplementController@update', $supplement)];
        $restaurant_selected = $supplement->restaurant;
    }else {
        $options = ['method' => 'post', 'url'=>action('SupplementController@store')];
    }
?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('supplements.form') }}
@stop

{!! Form::model($supplement, $options) !!}
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <label for="document">Importer des images [ max : 5 ]</label>
            <div class="dropzone" id="document-dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Prix') !!}
            <div class="input-group">
                {!! Form::number('price', $supplement->id ?  $supplement->price : 0 , ['class' => 'form-control', 'required'=>'required', 'min'=>0]) !!}
                <div class="input-group-addon">
                    <b>{{ $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) }}</b>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null , ['class' => 'form-control', 'rows'=>'5']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'Selectionner une categorie') !!}
                {!! Form::select('category_id', array_map("__", $restaurant_selected->categories()->forSupplements()->pluck('name', 'id')->toArray()), null , ['class' => 'form-control category-select']) !!}
            </div>
            <div class="form-group">
                <label for="is_available">
                    {{ Form::checkbox('is_available', null, !$supplement->id ? 'checked' : null) }} Ce supplement est actuellements disponible 
                </label>
            </div>
    </div>
</div>
    @if(!$supplement->id && isset($restaurant_selected))
    {!! Form::hidden('restaurant_id', $restaurant_selected->id) !!}
    @endif
    {!! Form::submit(null , ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 
@section('scripts')
    @parent

    @include('utilities.dropzone', ['model' => isset($supplement->id) ? $supplement : null])
@endsection