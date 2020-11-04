@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('terms_of_use') }}
@stop

@section('main')

    <div class="row">
        <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
                    <h3 class="box-title">{{ __('Terms of use') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! !empty($terms) ? $terms->value : '' !!}
                    </div>
                    <!-- /.box-body -->
                </div>
        </div>
    </div>
@stop