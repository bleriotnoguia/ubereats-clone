@extends('layouts.app')
@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@stop
@php
    if(isset($_restaurant)){
        $orders = $_restaurant->orders;
    }else if(!isset($orders)){
        $orders = collect([]);
    }
@endphp
@section('main')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $orders->count()  }}</h3>
                <p>Commandes</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route("orders.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
            <div class="inner">
                {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                @if(Auth::user()->isSuperAdmin())
                    <h3>{{ $restaurants->count()  }}</h3>
                    <p>Boutiques</p>
                @else
                    <h3>{{ isset($_restaurant) ? $_restaurant->items->count() : '0'  }}</h3>
                    <p>Articles</p>
                @endif
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            @if(Auth::user()->isSuperAdmin())
                <a href="{{ route("restaurants.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            @else
                <a href="{{ route("items.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
            @if(Auth::user()->isSuperAdmin())
                <div class="inner">
                    <h3>{{ isset($users) ? $users->count() : '0' }}</h3>

                    <p>Utilisateur(s)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route("users.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            @else
                <div class="inner">
                    <h3>{{ isset($customers) ? $customers->count() : '0' }}</h3>

                    <p>Client(s)</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route("customers.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            @endif
            
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ isset($shippers) ? $shippers->count() : '0' }}</h3>

                <p>Expéditeurs</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route("shippers.index") }}" class="small-box-footer">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @if(Auth::user()->isSuperAdmin())
        @php
        $models = $users;
        $toDisplay = [ 
            'first_name' => 'Prenom', 
            'last_name' => 'Nom',  
            'email' => 'Email',
            'phone_number' => "Numéro de télephone",
            'location' => 'Emplacement',
            'country_name' => 'Pays',
            'city_name' => 'Vile',
            'address_description' => 'Description de l\'adresse'
        ];
        @endphp

        @component('utilities.modalhtml')
        @slot('title')
            Détails de l'utilisateur
        @endslot
        @foreach ($toDisplay as $key => $value)
            <tr>
                <th>{{ $value }}</th>
                <td class="{{ $key }}">default text</td>
            </tr>
        @endforeach
        @endcomponent
    @endif
    <div class="row">
        @if(Auth::user()->isSuperAdmin())
        <div class="col-md-4">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Nouveaux utilisateurs</h3>

              <div class="box-tools pull-right">
                <span class="label label-danger">{{__('Recently registered users')}}</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                @foreach ($users->take(8) as $user)
                <li>
                    <img src="{{ asset($user->profile_img) }}" alt="User Image" style="height: 82px">
                    <a class="users-list-name" href="#" onclick="showModal({{ $user->id }})">{{ $user->first_name .'  '. $user->last_name }}</a>
                    <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                </li>
                @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route("users.index") }}" class="uppercase">Tous les utilisateurs</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
        {{-- LASTEST RESTAURANTS --}}
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Recently created shops') }}</h3>
    
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                    @foreach ($restaurants->take(4) as $restaurant)
                    <li class="item">
                        <div class="product-img">
                        <img src="{{asset($restaurant->profile_img)}}" alt="Product Image" class="lazyload">
                        </div>
                        <div class="product-info">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="product-title">{{$restaurant->name}}
                            <span class="label label-success pull-right">{{ $restaurant->created_at->diffForHumans() }}</span></a>
                        <span class="product-description">
                                {{$restaurant->location}}
                            </span>
                        </div>
                    </li>
                    @endforeach
                    <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="{{route('restaurants.index')}}" class="uppercase">{{__('See all the shops')}}</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        @elseif(Auth::user()->isShopAdmin())
        {{-- TABLE : LASTEST ORDERS --}}
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('The last 5 orders')}} </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Numéro</th>
                    <th>Total</th>
                    <th>Client (prenom et nom)</th>
                    <th>Client (email)</th>
                    <th>Créer le</th>
                    <th>Etat</th>
                  </tr>
                  </thead>
                  <tbody>
                @if(isset($_restaurant))
                @foreach ($_restaurant->orders()->latest()->get()->take(5) as $order)
                  <tr>
                    <td><a href="{{ route('orders.show', $order) }}" class="text-bold">{{$order->number}}</a></td>
                    <td>{{$formatter->formatCurrency($order->total, env('CURRENCY_CODE'))}}</td>
                    <td>{{$order->user->first_name .'  '.$order->user->last_name}}</td>
                    <td>{{$order->user->email}}</td>
                    <td>{{$order->created_at->format('d/m/Y H:i')}}</td>
                    <td>{!! $order->status_html !!}</td>
                  </tr>
                  @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="{{route('orders.index')}}" class="btn btn-sm btn-info btn-flat pull-right">{{__('See all orders')}}</a>
            </div>
            <!-- /.box-footer -->
          </div>
        </div>
        @endif
        <!-- /.col -->
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Order status')}}</h3>
    
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="chart-responsive">
                        <canvas id="pieChart" height="160" width="222" style="width: 222px; height: 160px;"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o text-red"></i> {{__('Canceled')}}</li>
                            <li><i class="fa fa-circle-o text-yellow"></i> {{__('Pending')}}</li>
                            <li><i class="fa fa-circle-o text-aqua"></i> {{__('Ready')}}</li>
                            <li><i class="fa fa-circle-o text-light-blue"></i> {{__('In shipment')}}</li>
                            <li><i class="fa fa-circle-o text-green"></i> {{__('Shipped')}}</li>
                            <li><i class="fa fa-circle-o text-gray"></i> {{__('Confirmed')}}</li>
                        </ul>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-sm-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gains</h3>
        
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                        <canvas id="barChart" style="height: 230px; width: 627px;" width="627" height="230"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
      </div>
@endsection

@section('scripts')
@if(Auth::user()->isSuperAdmin())
    @include('utilities.modalscript')
@endif
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
            var PieData = [
                {
                    value    : {{ $orders->where('status', 'canceled')->count() }},
                    color    : '#f56954',
                    highlight: '#f56954',
                    label    : '{{__("Canceled")}}'
                },
                {
                    value    : {{ $orders->where('status', 'shipped')->count() }},
                    color    : '#00a65a',
                    highlight: '#00a65a',
                    label    : '{{__("Shipped")}}'
                },
                {
                    value    : {{ $orders->where('status', 'pending')->count() }},
                    color    : '#f39c12',
                    highlight: '#f39c12',
                    label    : '{{__("Pending")}}'
                },
                {
                    value    : {{ $orders->where('status', 'in_shipment')->count() }},
                    color    : '#3c8dbc',
                    highlight: '#3c8dbc',
                    label    : '{{__("In shipment")}}'
                },
                {
                    value    : {{ $orders->where('status', 'confirmed')->count() }},
                    color    : '#d2d6de',
                    highlight: '#d2d6de',
                    label    : '{{__("Confirmed")}}'
                }
            ];
          var areaChartData = {
                labels  : @json(array_map('__', array_keys($earnings))),
                datasets: [
                    {
                        label               : 'earnings per month',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : @json(array_values($earnings))
                    }
                ]
            }
    </script>
    <script src="{{ asset('js/chart-demo.js') }}"></script>
@endsection