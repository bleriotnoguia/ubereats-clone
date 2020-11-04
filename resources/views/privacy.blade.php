@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('privacy_policy') }}
@stop

@section('main')

    <div class="row">
        <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
                    <h3 class="box-title">{{ __('Privacy policy') }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! !empty($privacy) ? $privacy->value : '' !!}
                    </div>
                    <!-- /.box-body -->
                </div>
        </div>
    </div>
@stop