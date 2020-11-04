<?php
    if($notation->id){
        $options = ['method' => 'put', 'url'=>action('NotationController@update', $notation)];
    }else {
        $options = ['method' => 'post', 'url'=>action('NotationController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

@section('breadcrumbs')
    {{ Breadcrumbs::render('notations.form') }}
@stop

{!! Form::model($notation, $options) !!}
        @if(!$notation->id)
            <div class="form-group">
                {!! Form::label('user_id', 'Selectionner un utilisateur') !!}
                {!! Form::select('user_id', [] , null , ['class' => 'form-control ajax-users-multiple', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('order_number', 'Entrer le numéro de la commande') !!}
                {!! Form::text('order_number', null , ['class' => 'form-control', 'required'=>'required']) !!}
            </div>
            {!! Form::hidden('model_name', isset(\Request::query()['corcerned']) ? \Request::query()['corcerned'] : null ) !!}
        @endif
        <div class="form-group">
            {!! Form::label('star', 'Nombre d\'etoile') !!}
            {!! Form::number('star', null, ['min'=>0, 'max'=>5, 'required'=>'required', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('like', 'Like / Unlike') !!}
            {!! Form::select('like', [1 => 'like', 0 => 'unlike'] , null, ['class' => 'form-control like', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('comment', 'Commentaire') !!}
            {!! Form::textarea('comment', null , ['class' => 'form-control', 'rows'=>'5', 'required'=>'required']) !!}
        </div>
        <div class="form-group">
            <strong>Criteria:</strong>
            <br/>
            @foreach($criteria as $value)
                <label style='margin: 20px 20px auto auto'>
                    {{ Form::checkbox('criteria[]', $value->id, in_array($value->id, $notation->criteria->pluck('id')->toArray()) ? true : false, array('class' => 'name')) }}
                    {{ $value->name }}
                </label>
            @endforeach
        </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 