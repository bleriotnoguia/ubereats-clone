@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', 'Roles list')

@section('title_header', 'Roles')
@section('sub_title_header', 'Liste des roles')

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<p class="text-left">
    <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ajouter</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les roles</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$role->name}}</td>
                        <td style="width: 20%">
                            @if($role->getPermissionNames()->count() > 0)
                                @foreach($role->getPermissionNames() as $v)
                                    <label class="label label-info">{{ $v }}</label>
                                @endforeach
                            @else
                                <p class="text-info">Aucune permissions</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
@stop()
@section('scripts')
@include('utilities.js-dataTables')
@stop 