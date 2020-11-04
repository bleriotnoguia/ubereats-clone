@extends('layouts.app') 

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', 'Menus')

@section('title_header', 'Menus')
@section('sub_title_header', 'Gestion des menus')

@section('breadcrumbs')
    {{ Breadcrumbs::render('menus') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<p class="text-left">
    <a href="{{ route('menus.create', isset($_restaurant) ? $_restaurant->id : '') }}" class="btn btn-primary" title="Ajouter un menu"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les menus</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                    <tr role="row">
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{__($menu->name)}}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['menus.destroy', $menu->id]]) !!}
                            <button type="button" onclick='allow("Confirmez vous la suppresion de ce menu ?", this, true)' class = "btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
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