@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css') }}">
@stop

@section('title_header', 'Profile')
@section('sub_title_header',  __( ucfirst($restaurant->type).' '.'profile'))

@section('main')
@include('utilities.flash')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset($restaurant->user->profile_img) }}" style="height: 110px" alt="User profile picture">
          <h3 class="profile-username text-center">{{$restaurant->user->full_name  }}</h3>
          <p class="text-center">{{ __( ucfirst($restaurant->type).' '.'administrator') }}</p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-map-marker margin-r-5"></i> Adresse</b> <a class="pull-right">{{ $restaurant->user->location }}</a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-phone margin-r-5"></i> Numéro de téléphone</b> <a class="pull-right">{{ $restaurant->user->phone_number }}</a>
                </li>
                <li class="list-group-item">
                    <b><i class="fa fa-file-text-o margin-r-5"></i> Inscrit le </b> <a class="pull-right">{{ \Carbon\Carbon::parse($restaurant->user->created_at)->format('d-m-Y à H:i:s') }}</a>
                </li>
              </ul>
              <a href="{{ route('users.edit',$restaurant->user) }}" class="btn btn-primary btn-block"><b>Editer</b></a>
              <a href="{{ route('users.show_password_form', $restaurant->user) }}" class="btn btn-primary btn-block"><b>Changer le mot de passe</b></a>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#detail-data" data-toggle="tab" aria-expanded="true">{{ $restaurant->is_merchant ? __('Commerce') : __('Restaurant') }}</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="detail-data">
                <div style="padding: 1rem 2rem">
                <h4>{{ $restaurant->is_merchant ? "Information sur le commerce" : "Information sur le restaurant" }}</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <td class="name">{{$restaurant->name}}</td>
                        </tr>
                        <tr>
                            <th>Temps de livraison</th>
                            <td class="deliveries_time">{{$restaurant->deliveries_time}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td class="email">{{ $restaurant->email }}</td>
                        </tr>
                        <tr>
                            <th>Numéro de télephone</th>
                            <td class="phone_number">{{ $restaurant->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Emplacement</th>
                            <td class="location">{{$restaurant->location}}</td>
                        </tr>
                        <tr>
                            <th>Nombre d'article</th>
                            <td class="items">{{count($restaurant->items)}}</td>
                        </tr>
                        <tr>
                            <th>Date de création</th>
                            <td class="created_at">{{$restaurant->created_at->format('d-m-Y à H:i:s')}}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-primary"><i class="fa fa-edit"></i> <b>Editer</b></a>
                <a href="{{ auth()->user()->isSuperAdmin() ? route('restaurants.items_index', $restaurant) : route('items.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> <b>Liste des articles</b></a>
                </div>
              </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </div> 
@endsection

@section('scripts')
<script src="{{ asset('adminlte/plugins/select2/select2.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
<script src="{{ asset('adminlte/plugins/iCheck/iCheck.min.js') }}"></script>
@stop