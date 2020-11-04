@extends('layouts.app')

@section('css')
@include('utilities.css-dataTables')
@endsection

@section('title', __('Finance managment'))

@section('title_header', 'Tableau de bord - Boutique : '.$user->restaurant->name)
@section('sub_title_header', 'Suivi des transactions et état des comptes')

@section('breadcrumbs')
    @if (Auth::user()->isSuperAdmin())
        {{ Breadcrumbs::render('shops_payouts.wallet') }}
    @else
        {{ Breadcrumbs::render('wallet') }}
    @endif
@stop

@section('main')
@php
    $i = 0;
@endphp
<div class="row">
<div class="col-lg-6 col-xs-6">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Gains et transactions</h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="chart">
            <canvas id="lineChart" style="height: 215px; width: 541px;" width="541" height="215"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>{{ $formatter->formatCurrency($user->balance, env('CURRENCY_CODE')) }}</h3>
            <p>Dans votre compte</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3>{{ $formatter->formatCurrency($amount_lost['month'], env('CURRENCY_CODE')) }}</h3>
            <p>Commandes échouées ce mois</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $formatter->formatCurrency($amount_won['month'], env('CURRENCY_CODE')) }}</h3>
                <p>De revenu ce mois</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3>{{ $formatter->formatCurrency($amount_won['year'], env('CURRENCY_CODE')) }}</h3>
            <p>De revenu cette année</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer in-dev-info">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#deposit-transaction" data-toggle="tab" aria-expanded="false">{{ __('Deposit transaction') }}</a></li>
      <li><a href="#withdraw-transaction" data-toggle="tab" aria-expanded="true">{{ __('Withdraw transaction') }}</a></li>
    </ul>
    <div class="tab-content">
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="deposit-transaction">
            <div style="padding: 1rem 2rem">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Transactions recentes</strong></h3>
                    </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                                <table id="modelTable" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>{{ __('Order number') }}</th>
                                            <th>{{ __('Transaction id') }}</th>
                                            <th>{{ __('Order total') }}</th>
                                            <th>{{ __('Ubereats fee') }}</th>
                                            <th>{{ __('Deposit amount') }}</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->wallet->transactions()->where('type','deposit')->latest()->get() as $transaction)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                                <td><a href="{{ isset($transaction->order_id) ? route('orders.show', $transaction->order_id) : '' }}">{{ $transaction->order_number }}</a></td>
                                                <td>{{ $transaction->hash }}</td>
                                                <td>{{ $formatter->formatCurrency($transaction->initial_amount, env('CURRENCY_CODE')) }}</td>
                                                <td>{{ $formatter->formatCurrency($transaction->ubereats_fee, env('CURRENCY_CODE')) }}</td>
                                                <td>{{ $formatter->formatCurrency($transaction->amount, env('CURRENCY_CODE')) }}</td>
                                                <td>
                                                    <a href="{{ route('payouts.pdf', $transaction) }}" title="Télécharger en pdf" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>{{ __('Order number') }}</th>
                                            <th>{{ __('Transaction id') }}</th>
                                            <th>{{ __('Order total') }}</th>
                                            <th>{{ __('Ubereats fee') }}</th>
                                            <th>{{ __('Deposit amount') }}</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                <!-- /.box -->
            </div>
        </div>
            <!-- /.tab-pane -->
        <div class="tab-pane" id="withdraw-transaction">
            <div style="padding: 1rem 2rem">
                <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Transactions recentes</strong></h3>
                        </div>
                        @php
                            $i = 0;
                        @endphp
                            <!-- /.box-header -->
                            <div class="box-body">
                                    <table id="modelTable2" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr role="row">
                                                <th>N°</th>
                                                <th>Date</th>
                                                <th>{{ __('Transaction_id') }}</th>
                                                <th>{{ __('Net payout') }}</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->wallet->transactions()->where('type','withdraw')->latest()->get() as $transaction)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $transaction->hash }}</td>
                                                    <td>{{ $formatter->formatCurrency($transaction->amount, env('CURRENCY_CODE')) }}</td>
                                                    <td>
                                                        <a href="{{ route('payouts.pdf', $transaction) }}" title="Télécharger en pdf" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>N°</th>
                                                <th>Date</th>
                                                <th>{{ __('Transaction_id') }}</th>
                                                <th>{{ __('Net payout') }}</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                    <!-- /.box -->
            </div>
        </div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
    <!-- /.nav-tabs-custom -->
@endsection

@section('scripts')
@include('utilities.js-dataTables')
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>

    $(function () {
        $('#modelTable2').DataTable({
            "language": language_datatable
        });
    })

    $(function () {
       /* ChartJS
        * -------
        * Here we will create a few charts using ChartJS
        */

        var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale               : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - Whether the line is curved between points
        bezierCurve             : true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot                : false,
        //Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive              : true
        }

        //--------------------
        //- AREA CHART DATA -
        //--------------------

        var areaChartData = {
          labels  : @json(array_map('__', array_keys($earnings))),

            datasets: [
            // {
            //     label               : 'Electronics',
            //     fillColor           : 'rgba(210, 214, 222, 1)',
            //     strokeColor         : 'coral',
            //     pointColor          : 'rgba(210, 214, 222, 1)',
            //     pointStrokeColor    : '#c1c7d1',
            //     pointHighlightFill  : '#fff',
            //     pointHighlightStroke: 'rgba(220,220,220,1)',
            //     data                : [65, 59, 80, 81, 56, 55, 40]
            // },
            {
                label               : 'Digital Goods',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : @json(array_values($earnings))
            }
            ]
        }


        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
        var lineChart                = new Chart(lineChartCanvas)
        var lineChartOptions         = areaChartOptions
        lineChartOptions.datasetFill = false
        lineChart.Line(areaChartData, lineChartOptions)
    })
    </script>
    {{-- <script src="{{ asset('js/demo.js') }}"></script> --}}

   {{-- @include('utilities.modalscript') --}}
@endsection