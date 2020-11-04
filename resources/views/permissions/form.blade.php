<?php
    if($permission->id){
        $options = ['method' => 'put', 'url'=>action('PermissionController@update', $permission)];
    }else {
        $options = ['method' => 'post', 'url'=>action('PermissionController@store')];
    }
    
    $rolesFr = ['super-admin' => 'Super Admin', 'shop-admin' => 'Administrateur de boutique', 'shipper' => 'Expediteur'];
?>

@include('utilities.errors')
@include('utilities.flash')

{!! Form::model($permission, $options) !!}
        <div class="form-group">
            {!! Form::label('name', 'Permission') !!}
            {!! Form::text('name', null , ['class' => 'form-control', 'disabled'=>'disabled']) !!}
        </div>
        <div class="form-group">
            {{-- If no roles exist yet --}}
        @if(!$roles->isEmpty()) 
            <strong>Assigner la permission aux roles</strong>
            <br>
            @foreach ($roles as $role) 
                <label style='margin: 20px 20px auto auto'>
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, $rolesFr[$role->name]) }}
                </label>
            @endforeach
        @endif
        </div>
        {!! Form::submit(null, ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!} 