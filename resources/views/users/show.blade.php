@extends('layouts.app')

@section('title', $user->full_name)

@section('title_header', 'Mon Profile')
@section('sub_title_header', 'Détails de mon profile')

@section('breadcrumbs')
    {{ Breadcrumbs::render('users.profile') }}
@stop

@section('main')
<div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset($user->profile_img) }}" style="height: 110px" alt="User profile picture">

            <h3 class="profile-username text-center">{{$user->first_name .'  '.$user->last_name  }}</h3>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i>Adresse</strong>
              <p class="text-muted">{{ $user->location }}</p>
              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
              <p>Ces informations sont celles renseignées lors de la création de votre compte.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#detail-data" data-toggle="tab" aria-expanded="false">Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="detail-data">
                <div style="padding: 1rem 2rem">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Email</th>
                            <td class="email">{{$user->email }}</td>
                        </tr>
                        <tr>
                            <th>Numéro de téléphone</th>
                            <td class="phone_number">{{$user->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td class="location">{{ $user->location }}</td>
                        </tr>
                        <tr>
                            <th>Inscrit le </th>
                            <td class="created_at">{{ $user->created_at->format('d-m-Y à H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td class="role">{!! '<label class="label label-primary">'.mb_strtolower($user->role, 'UTF-8').'</label>' !!}</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users.edit',$user) }}" class="btn btn-primary align-rigth">Editer</a>
                <a href="{{ route('users.show_password_form', $user) }}" class="btn btn-primary align-rigth">Changer le mot de passe</a>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
@endsection