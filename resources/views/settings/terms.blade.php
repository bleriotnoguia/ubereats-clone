@extends('layouts.partials.crud')

@section('title', __('Edit terms of use'))

@section('breadcrumbs')
    {{ Breadcrumbs::render('settings.terms_of_use') }}
@stop

@section('main')

@include('utilities.errors')
@include('utilities.flash')

<div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Terms of use
        <small>Use this editor to write your terms of use</small>
      </h3>
      <!-- tools box -->
      <div class="pull-right box-tools">
        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /. tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body pad">
      <form method="POST" action="{{ route('settings.store_terms') }}">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <textarea id="ck-editor" name="terms" rows="15" cols="80">
                {{ isset($terms_of_use) && $terms_of_use->value ? $terms_of_use->value : 'Write your terms of use here' }}
            </textarea>
            <button type="submit" class="btn btn-primary pull-right" style="margin-top: 10px;">Appliquer les modifications</button>
      </form>
    </div>
  </div>
  <!-- /.box -->

  @endsection

  @section('scripts')
  <!-- CK Editor -->
<script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js') }}"></script>
  <script>
    $(function () {
      // Replace the <textarea id="ck-editor"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('ck-editor')
    })
  </script>
  @endsection