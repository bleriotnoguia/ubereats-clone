@extends('layouts.app') 

@section('css')
    @include('utilities.css-dataTables')
@endsection

@section('title', 'Cuisines')

@section('title_header', 'Cuisines')
@section('sub_title_header', 'Gestion des cuisines')

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuisines') }}
@stop

@section('main')
@php
    // Numéro dans la table
    $i = 0;
@endphp
@include('utilities.flash')
<p class="text-left">
    <a href="{{route('cuisines.create')}}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
</p>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tous les cuisines</h3>
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
                    @foreach ($cuisines as $menu)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$menu->name}}</td>
                        <td>
                            <a href="{{ route('cuisines.edit', $menu) }}" class="btn btn-primary" title="Editer"><i class="fa fa-pencil"></i></a>
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