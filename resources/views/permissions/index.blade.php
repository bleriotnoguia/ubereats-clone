@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', 'Permissions list')

@section('title_header', 'Permissions')
@section('sub_title_header', 'Liste des permissions')

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<p class="text-left">
    <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ajouter</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les permissions</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$permission->name}}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
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
    <script>
    </script>
@stop 