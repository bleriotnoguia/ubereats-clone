<?php
    if($role->id){
        $options = ['method' => 'put', 'url'=>action('RoleController@update', $role)];
    }else {
        $options = ['method' => 'post', 'url'=>action('RoleController@store')];
    }

?>

@include('utilities.errors')
@include('utilities.flash')

{!! Form::model($role, $options) !!}
        <div class="form-group">
            {!! Form::label('name', 'Role') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'disabled'=>'disabled']) !!}
        </div>
        <div class="form-group">
                <strong>Permissions:</strong>
                <br/>
                @foreach($permissions as $value)
                    <label style='margin: 20px 20px auto auto'>
                        {{ Form::checkbox('permission[]', $value->id, isset($rolePermissions) && in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}
                    </label>
                @endforeach
            </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 