<?php
if ($item->id) {
    $options = ['method' => 'put', 'url' => action('ItemController@update', $item)];
    $restaurant_selected = $item->restaurant;
} else {
    $options = ['method' => 'post', 'url' => action('ItemController@store')];
}
$shop_condition = !$restaurant_selected->is_merchant;
?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('items.form') }}
@stop

{!! Form::model($item, $options) !!}
<div class="row">
    <div class="col-sm-6">
        <h4>Informations sur l'article</h4>
        <div class="form-group">
            {!! Form::label('name', 'Nom') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <label for="document">Importer des images [ max : 5 ]</label>
            <div class="dropzone" id="document-dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple/>
                </div>
            </div>
        </div>
        <br>
        {{-- <div class="form-group">
            {!! Form::label('cuisine_id', 'Selectionner une cuisine') !!}
            {!! Form::select('cuisine_id', array_map("__", App\Models\Cuisine::pluck('name', 'id')->toArray()), null , ['class' => 'form-control cuisine-select']) !!}
        </div> --}}
        <div class="form-group">
            {!! Form::label('price', 'Prix') !!}
            <div class="input-group">
                {!! Form::number('price', null , ['class' => 'form-control', 'required'=>'required', 'min'=>0]) !!}
                <div class="input-group-addon">
                    <b>{{ $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) }}</b>
                </div>
            </div>
        </div>
        {{-- <div class="form-group">
            {!! Form::label('old_price', 'Ancien prix') !!}
            {!! Form::number('old_price', null , ['class' => 'form-control']) !!}
        </div> --}}
        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null , ['class' => 'form-control', 'rows'=>'5', 'required'=>'required']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <h4>Détails supplémentaires</h4>
                @if($shop_condition)
                    <div class="form-group">
                        {!! Form::label('menu_id', 'Selectionner un menu') !!}
                        {!! Form::select('menu_id', isset($item->id) ? array_map("__", $item->restaurant->menus->pluck('name', 'id')->toArray()) : array_map("__", $restaurant_selected->menus->pluck('name', 'id')->toArray()), null , ['class' => 'form-control category-select']) !!}
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('category_id', 'Selectionner une categorie') !!}
                    {!! Form::select('category_id', array_map("__", $restaurant_selected->categories()->forItems()->pluck('name', 'id')->toArray()), null , ['class' => 'form-control category-select']) !!}
                </div>
                <div class="form-group">
                    <label for="is_available">
                        {{ Form::checkbox('is_available', null, !$item->id ? 'checked' : null) }} Cet article est
                        actuellements disponible
                    </label>
                </div>
            </div>
            @if($shop_condition)
                <div class="col-sm-12 supplements-fields">
                    <h4>Ajouter un suppléments ?</h4>
                    @foreach($restaurant_selected->supplements->pluck('category')->unique() as $category)
                        <div class="form-group">
                            {{ ucfirst(__($category->name)) }} |
                            <label style='margin: 20px 20px auto auto;'>
                                Obligatoire ?
                                {{ Form::checkbox('obligatory_categories[]', $category->id, $item->obligatorySupplementCategory->contains($category) ? true : false, array('class' => 'name')) }}
                            </label>
                            {{ Form::select('supplements[]', $restaurant_selected->supplements->where('category_id', $category->id)->pluck('name', 'id')->all(), null , array('class' => 'form-control supplements-multiple', 'multiple' => true)) }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@if(!$item->id && isset($restaurant_selected))
    {!! Form::hidden('restaurant_id', $restaurant_selected->id) !!}
@endif
{!! Form::submit(null , ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 

@section('scripts')
    @parent

    @include('utilities.dropzone', ['model' => isset($item->id) ? $item : null])
@endsection