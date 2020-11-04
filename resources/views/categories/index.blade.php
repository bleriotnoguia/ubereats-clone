@extends('layouts.app')

@section('css')
    @include('utilities.css-dataTables')
@endsection

@section('title', 'Categories')

@section('title_header', 'Categories')
@section('sub_title_header', 'Gestion des categories')

@section('breadcrumbs')
    {{ Breadcrumbs::render('categories') }}
@stop

@section('main')
    @php
        // Numéro dans la table
        $i = 0;
    @endphp
    @include('utilities.flash')
    <p class="text-left">
        <a href="{{route('categories.create', isset($_restaurant) ? $_restaurant->id : '')}}" class="btn btn-primary"
           title="Ajouter une categorie"><i class="fa fa-fw fa-plus-circle"></i> Ajouter</a>
    </p>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tous les categories</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="modelTable" class="table table-bordered table-striped dataTable">
                <thead>
                <tr role="row">
                    <th>N°</th>
                    <th>Nom</th>
                    @if(!Auth::user()->restaurant->is_merchant)
                        <th>type</th>
                    @endif
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$category->name}}</td>
                        @if(!Auth::user()->restaurant->is_merchant)
                            <td>{{ __($category->type) }}</td>
                        @endif
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary"
                               title="Editer"><i class="fa fa-edit"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'style' => "display: inline", 'route' => ['categories.destroy', $category->id]]) !!}
                            <button type="button"
                                    onclick='allow("Confirmez vous la suppresion de cette categorie ?", this, true)'
                                    class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    @if(!Auth::user()->restaurant->is_merchant)
                        <th>type</th>
                    @endif
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