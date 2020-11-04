<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css"> --}}
    <style>
     .invoice {
        width: 100%;
        position: relative;
        background: #fff;
        border: 1px solid #f4f4f4;
        padding: 10px 20px;
        /* margin: 10px 25px */
    }
    
    .invoice-title {
        margin-top: 0
    }
    .invoice-col {
        float: left;
        width: 33.3333333%
    }
    .invoice-col-6{
        float: left;
        width: 48%;
        position: relative;
        min-height: 1px;
        padding-right: 1%;
        padding-left: 1%;
    }
    .table-responsive {
        overflow: auto
    }
    .table-responsive>.table tr th,
    .table-responsive>.table tr td {
        white-space: normal !important
    }
    /* .fa{
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .fa-globe:before{
        content: "\f0ac";
    } */

    </style>
    <title>Invoice PDF</title>
</head>
<body>
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
            <i class="fa fa-globe"></i> {{ config('app.name') }}, Inc.
            <small class="pull-right">Date: {{ $invoice->date }}</small>
            </h2>
        </div>
        <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
            <strong>{{ str_limit($invoice->order->restaurant->name, 24, '...') }}.</strong><br>
            {{ $invoice->order->restaurant->location }}<br>
            Phone : {{ $invoice->order->restaurant->phone_number }}<br>
            Email:  {{ $invoice->order->restaurant->email }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
            <strong>{{ $invoice->order->user->first_name. ' ' .$invoice->order->user->last_name }}</strong><br>
            Address: {{ $invoice->order->user->location }}<br>
            Phone: {{ $invoice->order->user->phone_number }}<br>
            Email: {{ $invoice->order->user->email }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice {{ $invoice->number }}</b><br>
            <b>Order ID:</b> {{ $invoice->order->number }}<br>
            <b>Payment Due:</b> {{ $invoice->date }}<br>
            <b>Account:</b> 
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
                <th>Qty</th>
                <th>Article</th>
                <th>Prix unitaire</th>
                <th>Description</th>
                <th>Sous total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invoice->order->orderLines as $line)
            <tr>
                <td>{{ $line->quantity }}</td>
                <td>{{ $line->model->name }}</td>
                <td>{{ $line->model->price }}</td>
                <td>{{ $line->model->description }}</td>
                <td>{{ $line->subtotal }}</td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
        <!-- accepted payments column -->
        <div class="invoice-col-6">
            <p class="lead">Payment Methods: <b>{{ $invoice->payment->method }}</b></p>
            {{-- <img src="{{ url("img/credit/visa.png") }}" alt="Visa">
            <img src="{{ url("img/credit/mastercard.png") }}" alt="Mastercard">
            <img src="{{ url("img/credit/american-express.png") }}" alt="American Express">
            <img src="{{ url("img/credit/paypal2.png") }}" alt="Paypal"> --}}

            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Tous vos paiements vous seront transferés chaque fin du mois.
            </p>
        </div>
        <!-- /.col -->
        <div class="invoice-col-6">
            <p class="lead">Amount Due 2/22/2014</p>

            <div class="table-responsive">
            <table class="table">
                <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{ $invoice->order->total}}</td>
                </tr>
                <tr>
                <th>Reduction  
                @if(isset($invoice->order->coupon_data['discount_type']) && $invoice->order->coupon_data['discount_type'] == 'percent')
                    {{ '( '.$invoice->order->coupon_data['discount_percent'].'% )' }}
                @endif
                
                </th>
                <td>{{ $invoice->order->reduction }}</td>
                </tr>
                <tr>
                <th>Shipping:</th>
                <td>{{ isset($invoice->order->shipping) ? $invoice->order->shipping->fee : '' }}</td>
                </tr>
                <tr>
                <th>Total:</th>
                <td>{{ $invoice->order->total_to_pay}}</td>
                </tr>
            </table>
            </div>
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</body>
</html>