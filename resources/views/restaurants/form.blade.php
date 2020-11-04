<?php
if ($restaurant->id) {
    $options = ['method' => 'put', 'url' => action('RestaurantController@update', $restaurant), 'id' => 'shop-form'];
} else {
    $options = ['method' => 'post', 'url' => action('RestaurantController@store'), 'id' => 'shop-form'];
}
?>

@include('utilities.errors')
@include('utilities.flash')
@include('utilities.mapmodal', ['title' => 'Position géographique votre boutique'])
@if(!$restaurant->id && Auth::user()->isSuperAdmin())
@if(isset($restaurant_admins) && empty($restaurant_admins))
<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<p>Vous ne pouvez pas créer de boutique car il n'existe aucun administrateur disponible. Commencer par <b><a href="{{ route('users.create') }}">créer un administrateur</a></b></p>
    </div>
@endif
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <p>Prenez soins de selectionner l'administrateur a qui vous souhaitez attribuer cette boutique</p>
</div>
@endif
@section('breadcrumbs')
    {{ Breadcrumbs::render('restaurants.form') }}
@stop

{!! Form::model($restaurant, $options) !!}
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#detail-data" data-toggle="tab" aria-expanded="true">Details</a></li>
      <li><a href="#schedule-data" data-toggle="tab" aria-expanded="true">Programmes</a></li>
    </ul>
    <div class="tab-content">
      <!-- /.tab-pane -->
      <div class="tab-pane active" id="detail-data">
            <div class="row" id="resto-form">
                <div class="col-sm-6">
                    @if(!$restaurant->id && Auth::user()->isSuperAdmin())
                        <div class="form-group">
                            {!! Form::label('user_id', 'Selctionner un administrateur') !!}
                            {!! Form::select('user_id', $restaurant_admins, null, ['class' => 'form-control admin-shop-select', 'required'=>'required'])  !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('name', 'Nom') !!}
                        {!! Form::text('name', null , ['class' => 'form-control', 'required'=>'required']) !!}
                    </div>
                    @if(!$restaurant->id)
                    <div class="form-group">
                            <p class="text-danger"><i class="fa fa-info-circle"></i> Une fois la sauvegarde effectuée  il est impossible de mettre à jour le type de boutique.</p>
                        <div class="form-group">
                            <label>
                                {{ Form::radio('is_merchant', 0, null, [isset($restaurant->id) && $restaurant->is_merchant == 0 || !isset($restaurant->id) ? 'checked' : null]) }}
                                Restaurant ( Il s'agit de ... )
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {{ Form::radio('is_merchant', 1, null, [isset($restaurant->id) && $restaurant->is_merchant == 1 ? 'checked' : null]) }}
                                Commerce ( Il s'agit de ... )
                            </label>
                        </div>
                    </div>
                    @endif
                    @if(($restaurant->id && !$restaurant->is_merchant) || !$restaurant->id)
                    <div class="form-group resto-input">
                        {!! Form::label('cuisines[]', 'Selectionner une cuisine') !!}
                        {!! Form::select('cuisines[]', App\Models\Cuisine::pluck('name', 'id')->toArray(), null , ['class' => 'form-control cuisine-multiple', 'multiple' => false]) !!}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="document">Importer des images [ max : 5 ]</label>
                        <div class="dropzone" id="document-dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Présentation de votre entreprise (300 caractères max)') !!}
                        {!! Form::textarea('description', null , ['class' => 'form-control', 'rows'=>'5', 'maxlength'=>300, 'required'=>'required']) !!}
                    </div>
                    @if(Auth::user()->isSuperAdmin())
                    <div class="form-group">
                        <p class="text-info"><i class="fa fa-info-circle"></i> Laissez le champ vide si vous voullez que les frais par defaut soient appliqués</p>
                        {!! Form::label('shipping_fee', __('Shipping fee for this shop')) !!}
                        <div class="input-group">
                            {!! Form::number('shipping_fee', null , ['class' => 'form-control', 'min'=>0 ]) !!}
                            <div class="input-group-addon">
                                <b>{{ $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) }}</b>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <div class="form-group {{ $errors->has('deliveries_time') ? 'has-error' : ''}}">
                        {!! Form::label('deliveries_time', 'Temps de livraison [ heure : minute ]') !!}
                        {!! Form::text('deliveries_time', $restaurant->id?null:'00:00' , ['class' => 'form-control timepicker', 'required'=>'required']) !!}
                        {!! $errors->first('deliveries_time', '<p class="help-block">:message</p>') !!}
                    </div>
                    @if(($restaurant->id && !$restaurant->is_merchant) || !$restaurant->id)
                    <div class="form-group resto-input">
                        {!! Form::label('preparation_time', 'Temps de preparation [ heure : minute ]') !!}
                        {!! Form::text('preparation_time', $restaurant->id ? null : '00:00' , ['class' => 'form-control timepicker', 'required'=>'required']) !!}
                    </div>
                    @endif
                    <fieldset>
                        <legend>{{ __('Location address') }}</legend>
                        <p class="text-right">Retrouvez votre entreprise depuis <a id="piker-location" href="#"><i class="fa fa-google" aria-hidden="true"></i>oogle map</a></p>
                        {!! $errors->first('gmap_address', '<p class="text-right text-danger"><i class="fa fa-info-circle"></i> Il est obligé de renseigner la position de l\'entreprise</p>') !!}
                        <div class="form-group">
                            {!! Form::label('address', 'Adresse') !!}
                            {!! Form::text('country', $restaurant->location ? $restaurant->location : null, ['class'=>'form-control', 'id'=>'address', 'disabled'=>'disabled'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Pays') !!}
                            {!! Form::text('country', $restaurant->country_name ? $restaurant->country_name : null, ['class'=>'form-control', 'id'=>'country', 'disabled'=>'disabled'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'Ville') !!}
                            {!! Form::text('city', $restaurant->city_name ? $restaurant->city_name : null, ['class'=>'form-control', 'id'=>'city', 'disabled'=>'disabled'] ) !!}
                        </div>
                    </fieldset>
                    <div class="form-group {{ $errors->has('address_description') ? 'has-error' : ''}}">
                        {!! Form::label('address_description', 'Description de l\'adresse ( obligatoire )') !!}
                        {!! Form::textarea('address_description', $restaurant->id && $restaurant->address ? $restaurant->address->description : null , ['class' => 'form-control', 'rows'=>'5', 'placeholder'=>'Nous sommes situé vers', 'required'=>'required']) !!}
                        {!! $errors->first('address_description', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
      </div>
    <!-- /.tab-content -->
    <!-- /.tab-pane -->
    <div class="tab-pane" id="schedule-data">
        <div style="padding: 0px 5%;">
            <h4>Horaire de la boutique</h4>
            <textarea id="dynamic_form" name="programmes">
                @if(isset($restaurant->id))
                    @json($restaurant->programmes->toArray())
                @else
                    [{"day_id":"1", "open_time":"6:00", "close_time": "16:00"}]
                @endif
            </textarea>
        </div>
    </div>
    <!-- /.tab-content -->
  </div>
  <!-- /.nav-tabs-custom -->
</div>
    {!! Form::hidden('gmap_address', isset($restaurant->address->gmap_address) ? json_encode($restaurant->address->gmap_address) : null, ['id' => 'gmap-address']) !!}
{{-- Attribution des droits d'administration au créateur, sinon on fait juste la modification du resto --}}
@if(!$restaurant->id && !Auth::user()->isSuperAdmin())
    {!! Form::hidden('user_id', Auth::user()->id) !!}
@endif
{!! Form::submit(null , ['class' => 'btn btn-primary', 'id'=>'shop-submit']) !!}
{!! Form::close() !!}

@section('scripts')

    @parent

    <script>
        $(document).ready(function(){

            var days = {
                1: "Lundi",
                2: "Mardi",
                3: "Mercredi",
                4: "Jeudi",
                5: "Vendredi",
                6: "Samedi",
                7: "Dimanche",
            };

            var all_days_ids = Object.keys(days);

            function getOptions(days_ids){
                var elems = '';
                var array_days_ids = days_ids ? days_ids : all_days_ids;

                array_days_ids.forEach(val => {
                    elems = elems + '<option value="'+val+'">'+days[val]+'</option>';
                });

                return elems;
            }

            function updateDays(){
                var selected_days_ids = $(".jour-multiple").map(function () {
                    if($(this).children("option:selected").val()){
                        return $(this).children("option:selected").val();
                    }
                }).get();

                $(".jour-multiple").children("option:not(:selected)").each(function() {
                    if($(this).val()){
                        $(this).remove();
                    }
                });
                available_days_ids = all_days_ids
                                .filter(x => !selected_days_ids.includes(x))
                                .concat(selected_days_ids.filter(x => !all_days_ids.includes(x)));
                $(".jour-multiple").append(getOptions(available_days_ids));

                // Timepicker
                $('.timepicker').timepicker({
                    showInputs: false,
                    showMeridian: false,
                    defaultTime: 'current'
                });

                // Select2
                $('.jour-multiple').select2({
                    width: '100%'
                });
            }

            var formInput = $(
                '<div class="formdic">\n' +
                '<div class="form-group">' +
                '<label for="day">Jour de la semaine - <span class="number">1</span></label>' +
                '<div class="input-group" style="width: 100%">' +
                '<select name="day_id" id="day" class="form-control jour-multiple" required>' +
                '<option value="" selected>Selctionner un jour</option>' +
                getOptions() +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="bootstrap-timepicker">' +
                '<div class="form-group">' +
                '<label>Heure d\'ouverture :</label>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control timepicker" name="open_time" required>' +
                '<div class="input-group-addon">' +
                '<i class="fa fa-clock-o"></i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="bootstrap-timepicker">' +
                '<div class="form-group">' +
                '<label>Heure de fermeture :</label>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control timepicker" name="close_time" required>' +
                '<div class="input-group-addon">' +
                '<i class="fa fa-clock-o"></i>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<div class="btn-control">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<input type="hidden" name="id">'
            );

            // I added costum code to this library to adapt it with my form
            $('#dynamic_form').multiInput({
                json: true,
                limit: 7,
                i18n: {
                    limitMessage: "Limite atteinte"
                },
                input: formInput,
                onElementAdd: function (el, plugin) {

                    updateDays();

                    $(".jour-multiple").each(function(){
                        $(this).change(function(){
                            updateDays();
                        });
                    });
                },
                onElementRemove: function (el, plugin) {
                    updateDays();
                }
            });

            updateDays();

            $('#shop-submit').click(function(e){
                e.preventDefault();
                programmes = JSON.parse($("textarea[name='programmes']").val());
                if(!programmes[0].day_id){
                    swal("Votre programme", "Renseigner d'abord votre programmes avant d'enregistrer !", "warning");
                    $("a[href='#schedule-data']").click();
                }else{
                    $('#shop-form').submit(); 
                }
            });
        });
    </script>
        @include('utilities.dropzone', ['model' => isset($restaurant->id) ? $restaurant : null])
@endsection